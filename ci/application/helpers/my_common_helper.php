<?php

function getversion() {
    return 3333333333333333;
}

function get_host_name() {
    return $_SERVER['HTTP_HOST'];
}

function assets_url($val = '') {
    if ($val) {
        return base_url($val);
    }

    return base_url();
}

function getipaddress() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')) {
        $ipaddress = getenv('HTTP_CLIENT_IP');
    } else if (getenv('HTTP_X_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    } else if (getenv('HTTP_X_FORWARDED')) {
        $ipaddress = getenv('HTTP_X_FORWARDED');
    } else if (getenv('HTTP_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    } else if (getenv('HTTP_FORWARDED')) {
        $ipaddress = getenv('HTTP_FORWARDED');
    } else if (getenv('REMOTE_ADDR')) {
        $ipaddress = getenv('REMOTE_ADDR');
    } else {
        $ipaddress = 'UNKNOWN';
    }

    return $ipaddress;
}

function mandatory() {
    return '<span style="color:#ff0000 !important;">*</span>';
}

/*
creates a directory if not exists and sets the required permission;
default is write permission

 */

function create_directory($path, $permission = 0777) {

    if ($path) {
        if (!is_dir($path)) {
            try {
                $old_umask = umask(0);
                @mkdir('./' . $path, $permission, TRUE); // RECURSIVE TRUE (THIRD ARGUMENT);
                @copy('./uploads/index.html', $path . 'index.html');
                umask($old_umask);
            } catch (ErrorException $ex) {
                return ['status' => 1, 'msg' => $ex->getMessage()];
            }
        }
        return ['status' => 0];
    }
    return ['status' => 1, 'msg' => 'Path not there.'];
}

function path_not_set($stat) {
    $CI = &get_instance();
    if ($stat['status'] == 1) {
        $CI->session->set_flashdata('messageE', $stat['msg']);
    }
}

function get_login_id() {
    $ci = &get_instance();
    if ($ci->session->userdata('loginid') != "") {
        $updatedby = $ci->session->userdata('loginid');
    } else {
        $updatedby = 1;
    }
    return $updatedby;

}

function alert_messages() {
    $CI = &get_instance();
    if ($CI->session->flashdata('messageS') != "") {

        return array('success', $CI->session->flashdata('messageS'));

    } elseif ($CI->session->flashdata('messageE') != "") {

        return array('error', $CI->session->flashdata('messageE'));

    } elseif ($CI->session->flashdata('messageW') != "") {

        return array('warning', $CI->session->flashdata('messageW'));

    } elseif ($CI->session->flashdata('messageI') != "") {

        return array('info', $CI->session->flashdata('messageI'));
    } else {
        return false;
    }

}

function show_messages() {
    $CI = &get_instance();
    if ($CI->session->flashdata('messageS') != "") {

        return '<div  class="alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        ' . $CI->session->flashdata('messageS') . '
        </div>';
    } elseif ($CI->session->flashdata('messageE') != "") {

        return '<div  class="alert alert-error fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        ' . $CI->session->flashdata('messageE') . '
        </div>';

    } elseif ($CI->session->flashdata('messageW') != "") {

        return '<div  class="alert alert-warning fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        ' . $CI->session->flashdata('messageW') . '
        </div>';

    } elseif ($CI->session->flashdata('messageI') != "") {

        return '<div  class="alert alert-info fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        ' . $CI->session->flashdata('messageI') . '
        </div>';
    }

}

function default_image() {
    return base_url('components/img/photos/24.jpg');
}

function getusernamehelper($alias = '', $ajaxcall = FALSE) {
    $alias = $alias ? $alias . '.' : '';

    if ($ajaxcall === TRUE) {
        // send without authentication id
        return '
        AES_DECRYPT(' . $alias . 'au_crickus, "' . EncriptKey . '") as au_crickus,
        AES_DECRYPT(' . $alias . 'au_crickf, "' . EncriptKey . '") as au_crickf,
        CAST(AES_DECRYPT(au_crickf, "' . EncriptKey . '") AS CHAR) AS orderbyfirstname,
        AES_DECRYPT(' . $alias . 'au_crickl, "' . EncriptKey . '") as au_crickl,
        AES_DECRYPT(' . $alias . 'au_crickpn, "' . EncriptKey . '") as au_crickpn,
        AES_DECRYPT(' . $alias . 'au_cricke, "' . EncriptKey . '") as au_cricke,
        ' . $alias . 'au_profile, ' . $alias . 'au_createdon, ' . $alias . 'au_status, ' . $alias . 'au_salt';

    }
    return $alias . 'authenticationid,
    AES_DECRYPT(' . $alias . 'au_crickus, "' . EncriptKey . '") as au_crickus,
    AES_DECRYPT(' . $alias . 'au_crickf, "' . EncriptKey . '") as au_crickf,
    CAST(AES_DECRYPT(' . $alias . 'au_crickf, "' . EncriptKey . '") AS CHAR) AS orderbyfirstname,
    AES_DECRYPT(' . $alias . 'au_crickl, "' . EncriptKey . '") as au_crickl,
    AES_DECRYPT(' . $alias . 'au_crickpn, "' . EncriptKey . '") as au_crickpn,
    AES_DECRYPT(' . $alias . 'au_cricke, "' . EncriptKey . '") as au_cricke,
    ' . $alias . 'au_profile, ' . $alias . 'au_createdon, ' . $alias . 'au_status, ' . $alias . 'au_salt';

}

function getuserdetailshelper($alias = '', $ajaxcall = FALSE) {
    $alias = $alias ? $alias : '';
    $aliasdot = $alias ? $alias . '.' : '';

    if ($ajaxcall === TRUE) {
        // send without authentication id
        return '
        AES_DECRYPT(' . $aliasdot . 'au_crickf, "' . EncriptKey . '") as au_crickf' . $alias . ',
        CAST(AES_DECRYPT(' . $aliasdot . 'au_crickf, "' . EncriptKey . '") AS CHAR) AS orderbyfirstname' . $alias . ',
        AES_DECRYPT(' . $aliasdot . 'au_crickl, "' . EncriptKey . '") as au_crickl' . $alias . ',
        AES_DECRYPT(' . $aliasdot . 'au_crickpn, "' . EncriptKey . '") as au_crickpn' . $alias . ',
        AES_DECRYPT(' . $aliasdot . 'au_cricke, "' . EncriptKey . '") as au_cricke' . $alias . ',
        ' . $aliasdot . 'au_profile as au_profile' . $alias . ',
        ' . $aliasdot . 'au_createdon as au_createdon' . $alias . ',
        ' . $aliasdot . 'au_status as au_status' . $alias . ',
        ' . $aliasdot . 'au_salt as au_salt' . $alias . '';

    }
    return $aliasdot . 'authenticationid,
    AES_DECRYPT(' . $aliasdot . 'au_crickf, "' . EncriptKey . '") as au_crickf' . $alias . ',
    CAST(AES_DECRYPT(' . $aliasdot . 'au_crickf, "' . EncriptKey . '") AS CHAR) AS orderbyfirstname' . $alias . ',
    AES_DECRYPT(' . $aliasdot . 'au_crickl, "' . EncriptKey . '") as au_crickl' . $alias . ',
    AES_DECRYPT(' . $aliasdot . 'au_crickpn, "' . EncriptKey . '") as au_crickpn' . $alias . ',
    AES_DECRYPT(' . $aliasdot . 'au_cricke, "' . EncriptKey . '") as au_cricke' . $alias . ',
    ' . $aliasdot . 'au_profile as au_profile' . $alias . ',
    ' . $aliasdot . 'au_createdon as au_createdon' . $alias . ',
    ' . $aliasdot . 'au_status as au_status' . $alias . ',
    ' . $aliasdot . 'au_salt as au_salt' . $alias . '';

}

function getresidentdetailshelper($alias = '', $ajaxcall = FALSE) {
    $alias = $alias ? $alias : '';
    $aliasdot = $alias ? $alias . '.' : '';

    if ($ajaxcall === TRUE) {
        // send without authentication id
        return '
        AES_DECRYPT(' . $aliasdot . 'rs_resfn, "' . EncriptKey . '") as ' . $alias . 'rs_resfn,
        CAST(AES_DECRYPT(' . $aliasdot . 'rs_resfn, "' . EncriptKey . '") AS CHAR) AS ' . $alias . 'orderbyfirstname,
        AES_DECRYPT(' . $aliasdot . 'rs_resln, "' . EncriptKey . '") as ' . $alias . 'rs_resln,
        AES_DECRYPT(' . $aliasdot . 'rs_phone, "' . EncriptKey . '") as ' . $alias . 'rs_phone,
        AES_DECRYPT(' . $aliasdot . 'rs_email, "' . EncriptKey . '") as ' . $alias . 'rs_email,
        ' . $aliasdot . 'rs_photo as ' . $alias . 'rs_photo,
        ' . $aliasdot . 'rs_updatedon as ' . $alias . 'rs_updatedon,
        ' . $aliasdot . 'rs_isactive as ' . $alias . 'rs_isactive';

    }
    return $aliasdot . 'rs_resid,
    AES_DECRYPT(' . $aliasdot . 'rs_resfn, "' . EncriptKey . '") as ' . $alias . 'rs_resfn,
    CAST(AES_DECRYPT(' . $aliasdot . 'rs_resfn, "' . EncriptKey . '") AS CHAR) AS ' . $alias . 'orderbyfirstname,
    AES_DECRYPT(' . $aliasdot . 'rs_resln, "' . EncriptKey . '") as ' . $alias . 'rs_resln,
    AES_DECRYPT(' . $aliasdot . 'rs_phone, "' . EncriptKey . '") as ' . $alias . 'rs_phone,
    AES_DECRYPT(' . $aliasdot . 'rs_email, "' . EncriptKey . '") as ' . $alias . 'rs_email,
    ' . $aliasdot . 'rs_photo as ' . $alias . 'rs_photo,
    ' . $aliasdot . 'rs_updatedon as ' . $alias . 'rs_updatedon,
    ' . $aliasdot . 'rs_isactive as ' . $alias . 'rs_isactive';

}

function default_profile_image() {
    return base_url('components/img/profile-pic.jpg');
}

function user_image($value, $salt = '', $attributes = false) {
    if (!empty($value)) {
        $src = base_url() . 'uploads/userimage/' . $salt . '/' . $value;
        if (file_exists('./uploads/userimage/' . $salt . '/' . $value) === false) {
            $src = default_profile_image();
        }
    } else {
        $src = default_profile_image();
    }

    $img = '<img src="' . $src . '" ';

    if (is_array($attributes)) {
        foreach ($attributes as $key => $value) {
            $img .= $key . '="' . $value . '"';
        }
    }

    $img .= ' >';

    return $img;
}

function get_employee_img_url($value = '', $salt = '') {
    if (!empty($value)) {
        $src = base_url() . 'uploads/userimage/' . $salt . '/' . $value;
        if (file_exists('./uploads/userimage/' . $salt . '/' . $value) === false) {
            $src = default_profile_image();
        }
    } else {
        $src = default_profile_image();
    }

    return $src;
}
function get_resident_img_url($value) {
    if (!empty($value)) {
        $src = base_url() . 'uploads/resident/' .  $value;
        if (file_exists('./uploads/resident/' . $value) === false) {
            $src = default_profile_image();
        }
    } else {
        $src = default_profile_image();
    }

    return $src;
}

function get_img_url($value = '', $folder = '') {
    if (!empty($value)) {
        $src = base_url() . 'uploads/' . $folder . '/' . $value;
        if (file_exists('./uploads/' . $folder . '/' . $value) === false) {
            $src = default_profile_image();
        }
    } else {
        $src = default_profile_image();
    }

    return $src;
}

function resident_image($value, $attributes = false) {
    if (!empty($value)) {
        $src = base_url() . 'uploads/resident/' . '/' . $value;
        if (file_exists('./uploads/resident/' . '/' . $value) === false) {
            $src = default_profile_image();
        }
    } else {
        $src = default_profile_image();
    }

    $img = '<img src="' . $src . '" ';

    if (is_array($attributes)) {
        foreach ($attributes as $key => $value) {
            $img .= $key . '="' . $value . '"';
        }
    }

    $img .= ' >';

    return $img;
}

if (!function_exists('linktag')) {
    function linktag($src = '') {
        return '<link href="' . assets_url($src) . '" rel="stylesheet">';
    }
}

if (!function_exists('script_tag')) {
    function script_tag($src = '', $language = 'javascript', $type = 'text/javascript', $index_page = FALSE) {
        $CI     = &get_instance();
        $script = '<scr' . 'ipt';
        if (is_array($src)) {
            foreach ($src as $k => $v) {
                if ($k == 'src' AND strpos($v, '://') === FALSE) {
                    if ($index_page === TRUE) {
                        $script .= ' src="' . assets_url($v) . '"';
                    } else {
                        $script .= ' src="' . $CI->config->slash_item('base_url') . $v . '"';
                    }
                } else {
                    $script .= "$k=\"$v\"";
                }
            }

            $script .= "></scr" . "ipt>\n";
        } else {
            if (strpos($src, '://') !== FALSE) {
                $script .= ' src="' . $src . '" ';
            } elseif ($index_page === TRUE) {
                $script .= ' src="' . assets_url($src) . '" ';
            } else {
                $script .= ' src="' . $CI->config->slash_item('base_url') . $src . '" ';
            }

            $script .= 'language="' . $language . '" type="' . $type . '"';
            $script .= ' /></scr' . 'ipt>' . "\n";
        }
        return $script;
    }
}

function listing_actions_styles($assessmentpagepermissionarray = [], $usertype = 0) {

    if ($usertype == 2 || $usertype == 3) {

        $output = '<style>';
        if (!empty($assessmentpagepermissionarray)) {
            if (!in_array(1, $assessmentpagepermissionarray)) {
                $output .= '.addnew{ display: none !important; }';

            }
            if (!in_array(2, $assessmentpagepermissionarray)) {
                $output .= '.view{  display: none !important; }';

            }
            if (!in_array(3, $assessmentpagepermissionarray)) {
                $output .= '.edit{  display: none !important; }';

            }
            if (!in_array(4, $assessmentpagepermissionarray)) {
                $output .= '.deletedisplay{ display: none !important;} ';

            }
            if (!in_array(5, $assessmentpagepermissionarray)) {
                $output .= '.export{ display: none !important;}';

            }
            if (!in_array(6, $assessmentpagepermissionarray)) {
                $output .= '.addreview{ display: none !important;}';

            }
        } elseif ($assessmentpagepermissionarray == "" || count_variable($assessmentpagepermissionarray) <= 0) {

            $output .= '.addnew{ display: none !important;}';
            $output .= '.view{ display: none !important;} ';
            $output .= '.edit{ display: none !important; }';
            $output .= '.deletedisplay{display: none !important; }';
            $output .= '.export{ display: none !important; } ';
            $output .= '.addreview{ display: none !important; } ';

        }
        $output .= '</style>';

        return $output;

    }

}

function listing_actions_types_ajax($assessmentpagepermissionarray = [], $usertype = 0) {
    $ci = &get_instance();   
    $ci->load->library('session');    
    $usertype= $ci->session->userdata('usertype'); 
    $output = array();
    if ($usertype == 2 || $usertype == 3) {

       
        if (!empty($assessmentpagepermissionarray)) {
            if (!in_array(1, $assessmentpagepermissionarray)) {
                $output[]='.addnew';

            }
            if (!in_array(2, $assessmentpagepermissionarray)) {
                $output[]= '.view';

            }
            if (!in_array(3, $assessmentpagepermissionarray)) {
                $output[]= '.edit';

            }
            if (!in_array(4, $assessmentpagepermissionarray)) {
                $output[]= '.deletedisplay';
                $output[]= '.delete';

            }
            if (!in_array(5, $assessmentpagepermissionarray)) {
                $output[]= '.export';

            }
            if (!in_array(6, $assessmentpagepermissionarray)) {
                $output[]= '.addreview';

            }
        } elseif ($assessmentpagepermissionarray == "" || count_variable($assessmentpagepermissionarray) <= 0) {

            $output[]= '.addnew';
            $output[]= '.view';
            $output[]= '.edit';
            $output[]= '.deletedisplay';
            $output[]= '.delete';
            $output[]= '.export';
            $output[]= '.addreview';

        }
        

       

    }
    return $output;
}

// removes white spaces & other special charaters

function clean_filename($filename) {
    return preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($filename));
}


