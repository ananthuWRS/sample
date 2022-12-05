<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('welcome/userauthentication_model', 'usersigin');
        // $this->load->model('admin/Facilities_model', 'facility');
    }

    public function index()
    {
        $this->data['title'] = "signin";
        $this->load->signintemplate('signin', $this->data, false);

        // $this->render($content);
    }

    public function signinauthentication()
    {
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));

        $validationdata = array(
            'username'     => $username,
            'userpassword' => $password,
        );
        if ($this->input->is_ajax_request()) {
            if ($this->usersigin->validate($validationdata, 'logincheck')) {
                $success = $this->usersigin->getuserdetails(array('AES_DECRYPT(au_crickus,"' . EncriptKey . '")' => $username, 'au_status' => '0'));

                if ($success && $success->authenticationid > 0) {
                    if (password_verify($password, trim($success->au_crickp))) {
                        if ($success->authenticationid > 0) {
                            $session_id        = $success->authenticationid;
                            $userrole          = $success->au_usertype;

                            if ($userrole == roles::admin) {
                                $sess_data = array(
                                    'authenticationid' => $success->authenticationid,
                                    'usertype'         => $success->au_usertype,
                                    'firstname'        => $success->au_crickf,
                                    'lastname'         => $success->au_crickl,
                                    'contactnumber'    => $success->au_crickpn,
                                    'usertypename'     => 'Admin',
                                );
                                $this->session->set_userdata($sess_data);
                                $this->session->set_flashdata('successmessage', 'User authentication success');
                                $result = array('status' => 'Yes', 'Message' => 'User authentication success', 'url' => 'admin');
                            } elseif ($userrole == roles::teachingstaff) {
                                $sess_data = array(
                                        'authenticationid' => $success->authenticationid,
                                        'usertype'         => $success->au_usertype,
                                        'firstname'        => $success->au_crickf,
                                        'lastname'         => $success->au_crickl,
                                        'contactnumber'    => $success->au_crickpn,
                                        'profilesalt'      => $success->au_salt,
                                        'usertypename'     => 'Teaching',
                                    );

                                 $redirecturl = 'staff';

                                $this->session->set_userdata($sess_data);
                                $this->session->set_flashdata('successmessage', 'User authentication success');
                                $result = array('status' => 'Yes', 'Message' => 'User authentication success', 'url' => $redirecturl);
                            } elseif ($userrole == roles::nonteachingstaff) {
                                $sess_data = array(
                                    'authenticationid' => $success->authenticationid,
                                    'usertype'         => $success->au_usertype,
                                    'firstname'        => $success->au_crickf,
                                    'lastname'         => $success->au_crickl,
                                    'contactnumber'    => $success->au_crickpn,
                                    'usertypename'     => 'Non Teching',
                                );

                                $redirecturl = 'staff';

                                $this->session->set_userdata($sess_data);
                                $this->session->set_flashdata('successmessage', 'User authentication success');
                                $result = array('status' => 'Yes', 'Message' => 'User authentication success', 'url' => $redirecturl);
                            } else {
                                $this->session->set_flashdata('errormessage', 'User authentication failed');
                                $result = array('status' => 'No', 'Message' => 'User authentication failed');
                            }
                        } else {
                            $this->session->set_flashdata('errormessage', 'User does not exist');
                            $result = array('status' => 'No', 'Message' => 'User does not exist');
                        }
                    } else {
                        $this->session->set_flashdata('errormessage', 'Invalid password');
                        $result = array('status' => 'No', 'Message' => 'Invalid password');
                    }
                } else {
                    $this->session->set_flashdata('errormessage', 'User does not exist');
                    $result = array('status' => 'No', 'Message' => 'User does not exist');
                }
            } else {
                $this->session->set_flashdata('errormessage', 'Please fill all required fields');
                $result = array('status' => 'No', 'Message' => 'Please fill all required fields');
            }
        } else {
            $this->session->set_flashdata('errormessage', 'Invalid request found');
            $result = array('status' => 'No', 'Message' => 'Invalid request found');
        }



        echo json_encode($result);
    }

    public function changepassword()
    {
        $this->data['vendorjs']        = array('parsleyjs/parsley.min.js');
        $this->data['commonjs']        = array('customscriptfiles.js');
        $this->data['scriptfunctions'] = array('changepassword();');
        $this->data['title']           = "Change Password";
        $this->load->template('changepassword', $this->data, false);
    }

    public function changepasswordprocess()
    {
        $curpassword     = $this->input->post('currentpassword', true);
        $password     = $this->input->post('newpassword', true);
        $confpassword = $this->input->post('confirmpassword', true);
        if ($password != "" && $confpassword != "" && $curpassword!="") {
            if ($password == $confpassword) {
                $date = date('Y-m-d H:i:s');

                $getProfileData  = $this->usersigin->getrowbyid($this->loggeduserid);

                if (password_verify($curpassword, trim($getProfileData->au_crickp))) {
                    $userpassword = password_hash($password, PASSWORD_DEFAULT);

                    $this->usersigin->update_status_by(array('authenticationid' => $this->loggeduserid), array('au_crickp' => $userpassword));

                    $this->session->set_flashdata('successmessage', 'Password Changed successfully');

                    $result = array('status' => 'Yes', 'Message' => 'Password Changed successfully');
                } else {
                    $this->session->set_flashdata('errormessage', 'Current  password is wrong');
                    $result = array('status' => 'No', 'Message' => 'Current  password is wrong');
                }
            } else {
                $this->session->set_flashdata('errormessage', 'Confirm password and password should be same');
                $result = array('status' => 'No', 'Message' => 'Confirm password and password should be same');
            }
        } else {
            $this->session->set_flashdata('errormessage', 'Error occured please try again');
            $result = array('status' => 'No', 'Message' => 'Error occured please try again');
        }
        echo json_encode($result);
    }



    public function dataprotection($clubid)
    {
        $this->load->model('facilities/Clubpolicy', 'clubpolicy');
        $this->data['clubpolicy'] = $this->clubpolicy->get_by(array('cp_clubid' => $clubid, 'cp_status' => '0'));
        $this->data['title']      = "Data Protection";
        $content                  = $this->load->view('dataprotection', $this->data, true);

        $this->render($content);
    }
    public function browsercookiepolicy($clubid)
    {
        $this->load->model('facilities/Clubpolicy', 'clubpolicy');
        $this->data['clubpolicy'] = $this->clubpolicy->get_by(array('cp_clubid' => $clubid, 'cp_status' => '0'));
        $this->data['title']      = "Browser cookie policy";
        $content                  = $this->load->view('browsercookiepolicy', $this->data, true);

        $this->render($content);
    }

    public function forgetpassword()
    {
        $this->data['title'] = "forget password";
        $content             = $this->load->view('forgetpassword', $this->data, true);

        $this->render($content);
    }

    public function forgetpasswordrequest()
    {
        $username = $this->security->xss_clean($this->input->post('username'));

        if ($this->input->is_ajax_request()) {
            if ($username != "") {
                $success = $this->usersigin->getuserdetails(array('AES_DECRYPT(au_crickus,"' . EncriptKey . '")' => $username, 'au_status' => '0'));

                if ($success && $success->authenticationid > 0) {
                    $userinsertiondata = array(
                        'au_passwordreset' => '1',

                    );
                    $userregistration = $this->usersigin->update_status_by(array('authenticationid' => $success->authenticationid), $userinsertiondata);

                    $this->load->library('email');




                    $this->load->library('email');
                    $config = array(
                        'mailtype' => 'html',
                        'charset' => 'iso-8859-1',
                        'wordwrap' => true,

                    );
                    $data = [
                        'firstname' =>$success->au_crickf,
                        'lastname' => $success->au_crickl,
                        'authid' => $success->authenticationid,
                        'auth' => $this->checksumgen($success->authenticationid),
                    ];

                    $sendemail = sendemailusingses($success->au_cricke, 'Forget Password |  ' . WEBSITE_NAME . ' ', $this->load->view('welcome/forgetpasswordemail', $data, true));



                    // $result = sendemailusingses($success->au_crickus, 'Reset Password Request ' . WEBSITE_NAME . '', $this->load->view('welcome/forgetpasswordemail', $this->data, true));
                    if ($sendemail) {
                        $result = array('status' => 'Yes', 'Message' => 'Reset password link sent to your email address');
                    } else {
                        $result = array('status' => 'No', 'Message' => 'Failed to generate reset password link,Please try again.');
                    }
                } else {
                    $this->session->set_flashdata('errormessage', 'Username/Email does not exist');
                    $result = array('status' => 'No', 'Message' => 'Username/Email does not exist');
                }
            } else {
                $this->session->set_flashdata('errormessage', 'Please fill all required fields');
                $result = array('status' => 'No', 'Message' => 'Please fill all required fields');
            }
        } else {
            $this->session->set_flashdata('errormessage', 'Invalid request found');
            $result = array('status' => 'No', 'Message' => 'Invalid request found');
        }
        echo json_encode($result);
    }

    public function resetpassword($id, $auth)
    {
        if ($this->validchecksumcheck($id, $auth)) {
            $this->data['title'] = "reset password";

            $success = $this->usersigin->getuserdetails(array('authenticationid' => $id, 'au_status' => '0'));

            if ($success->au_passwordreset == "1") {
                $this->data['authid'] = $success->authenticationid;
                $this->data['auth']   = $auth;
                $content              = $this->load->view('resetpassword', $this->data, true);
                $this->render($content);
            } else {
                $this->session->set_flashdata('errormessage', 'Invalid reset password request');
                redirect('welcome');
            }
        } else {
            $this->session->set_flashdata('errormessage', 'Invalid reset password request');
            redirect('welcome');
        }
    }

    public function resetpasswordprocess()
    {
        $authid             = $this->security->xss_clean($this->input->post('authid'));
        $auth               = $this->security->xss_clean($this->input->post('auth'));
        $signuppassword     = $this->security->xss_clean($this->input->post('signuppassword'));
        $signupconfpassword = $this->security->xss_clean($this->input->post('signupconfpassword'));
        $error              = array();
        if (!isset($signuppassword) || $signuppassword == "") {
            $error['signuppassword'] = "New password required";
        }
        if (!isset($signupconfpassword) || $signupconfpassword == "") {
            $error['signupconfpassword'] = "Confirm password required";
        }
        if ($signupconfpassword != $signupconfpassword) {
            $error['signupconfpassword'] = "New password should be equal to confirm password";
        }
        if (!count($error)) {
            if ($this->input->is_ajax_request()) {
                if ($this->validchecksumcheck($authid, $auth)) {
                    $success = $this->usersigin->getuserdetails(array('authenticationid' => $authid, 'au_status' => '0'));

                    if ($success && $success->authenticationid > 0) {
                        $saltstudent      = random_string('alnum', 16);
                        $userpassword     = md5($signuppassword . $saltstudent);
                        $userregistration = $this->usersigin->update_status_by(array('authenticationid' => $success->authenticationid), array('au_crickp' => $userpassword, 'au_salt' => $saltstudent, 'au_passwordreset' => '0'));

                        if ($userregistration) {
                            $result = array('status' => 'Yes', 'Message' => 'Your password resetted successfully');
                        } else {
                            $result = array('status' => 'No', 'Message' => 'Failed to set new  password,Please try again.');
                        }
                    } else {
                        $this->session->set_flashdata('errormessage', 'User does not exist');
                        $result = array('status' => 'No', 'Message' => 'User does not exist');
                    }
                } else {
                    $this->session->set_flashdata('errormessage', 'Please fill all required fields');
                    $result = array('status' => 'No', 'Message' => 'Please fill all required fields');
                }
            } else {
                $this->session->set_flashdata('errormessage', 'Invalid request found');
                $result = array('status' => 'No', 'Message' => 'Invalid request found');
            }
        } else {
            $this->session->set_flashdata('errormessage', $error[0]);
            $result = array('status' => 'No', 'Message' => $error[0]);
        }
        echo json_encode($result);
    }

    public function generatenumericotp($n)
    {
        $generator = "1357902468";

        $result = "";

        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }

        return $result;
    }

    public function checkusernameexits()
    {
        if (!$this->input->is_ajax_request()) {
            exit(lang('no_access_url'));
        }

        $username = $this->security->xss_clean($this->input->post('username'));

        $success = $this->usersigin->getuserdetails(array('AES_DECRYPT(au_crickus,"' . EncriptKey . '")' => $username));

        if ($success && $success->authenticationid > 0) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }




    public function createprofilepassword($id, $auth)
    {
        if ($this->validchecksumcheck($id, $auth)) {
            $userdetails = $this->usersigin->getuserdetails(array('authenticationid' => $id, 'au_status' => '0'));
            if ($userdetails) {
                if ($userdetails->au_firstlogin == "1") {
                    $this->data['title'] = "Create password";
                    $this->data['id']      = $id;
                    $this->data['auth']      = $auth;
                    $content  = $this->load->view('createpassword', $this->data, true);

                    $this->render($content);
                } else {
                    $this->session->set_flashdata('errormessage', 'You already created password for your profile');

                    redirect('welcome');
                }
            } else {
                $this->session->set_flashdata('errormessage', 'Account not available or  deactivated');

                redirect('welcome');
            }
        } else {
            $this->session->set_flashdata('errormessage', 'Invalid request');

            redirect('welcome');
        }
    }


    public function createpasswordprocess()
    {
        $authid             = $this->security->xss_clean($this->input->post('authid'));
        $auth               = $this->security->xss_clean($this->input->post('auth'));
        $signuppassword     = $this->security->xss_clean($this->input->post('signuppassword'));
        $signupconfpassword = $this->security->xss_clean($this->input->post('signupconfpassword'));
        $error              = array();
        if (!isset($signuppassword) || $signuppassword == "") {
            $error['signuppassword'] = "New password required";
        }
        if (!isset($signupconfpassword) || $signupconfpassword == "") {
            $error['signupconfpassword'] = "Confirm password required";
        }
        if ($signupconfpassword != $signupconfpassword) {
            $error['signupconfpassword'] = "New password should be equal to confirm password";
        }
        if (!count($error)) {
            if ($this->input->is_ajax_request()) {
                if ($this->validchecksumcheck($authid, $auth)) {
                    $success = $this->usersigin->getuserdetails(array('authenticationid' => $authid, 'au_status' => '0'));

                    if ($success && $success->authenticationid > 0) {
                        $saltstudent      = random_string('alnum', 16);
                        $userpassword     = md5($signuppassword . $saltstudent);
                        $date=date('Y-m-d H:i:s');
                        $userregistration = $this->usersigin->update_status_by(array('authenticationid' => $success->authenticationid), array('au_crickp' => $userpassword, 'au_salt' => $saltstudent, 'au_passwordreset' => '0', 'au_firstlogin' => '0','au_password_setdate'=>$date));

                        if ($userregistration) {
                            $this->session->set_flashdata('successmessage', 'Your password created successfully');
                            $result = array('status' => 'Yes', 'Message' => 'Your password created successfully');
                        } else {
                            $this->session->set_flashdata('errormessage', 'Failed to set new  password,Please try again.');
                            $result = array('status' => 'No', 'Message' => 'Failed to set new  password,Please try again.');
                        }
                    } else {
                        $this->session->set_flashdata('errormessage', 'Account not available or  deactivated');
                        $result = array('status' => 'No', 'Message' => 'Account not available or  deactivated');
                    }
                } else {
                    $this->session->set_flashdata('errormessage', 'Please fill all required fields');
                    $result = array('status' => 'No', 'Message' => 'Please fill all required fields');
                }
            } else {
                $this->session->set_flashdata('errormessage', 'Invalid request found');
                $result = array('status' => 'No', 'Message' => 'Invalid request found');
            }
        } else {
            $this->session->set_flashdata('errormessage', $error[0]);
            $result = array('status' => 'No', 'Message' => $error[0]);
        }
        echo json_encode($result);
    }

    public function profile()
    {
        $this->data['vendorjs']        = array('custom/parsleyjs/parsley.min.js');
        $this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
        // $this->data['scriptfunctions'] = array('taskSubcategory();');
        $this->data['title']           = "Profile";
        $this->data['profileactive']           = "1";
        $this->load->template('profile', $this->data, false);
    }

    public function settings()
    {
        $this->data['vendorjs']        = array('custom/parsleyjs/parsley.min.js');
        $this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
        $this->data['scriptfunctions'] = array('profilesettings();');
        $this->data['title']           = "Profile Settings";
        $this->data['profileactive']           = "2";
        $this->load->template('profilesettings', $this->data, false);
    }

    public function updateprofile()
    {
        $this->load->model('admin/Subcategory', 'subcategory');
        $fname = $this->input->post('fname', true);
        $lname = $this->input->post('lname', true);

        $email = $this->input->post('email', true);
        $phone = $this->input->post('phone', true);
        $address = $this->input->post('address', true);



        $validation = array('firstname' => $fname,'phone'=>$phone,'email'=>$email);
        if ($this->usersigin->validate($validation, 'updateprofile')) {
            $curdate = date('Y-m-d H:i:s');



            $inserted = $this->usersigin->updateauthenticationtable(array('authenticationid' => $this->loggeduserid), array(
                'au_crickf'=>$fname,
                'au_crickl'=>$lname,
                'au_crickpn'=>$phone,
                'au_cricke'=>$email,
                'au_cricka'=>$address,
            ));
           
            // if ($inserted) {
                $this->session->set_flashdata('successmessage', 'Profile  updated successfully.');
                $result = array('status' => 'Yes', 'Message' => 'Profile updated successfully');
            // } else {
            //     $this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
            //     $result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
            // }
        } else {
            $this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
            $result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
        }

        echo json_encode($result);
    }
}
