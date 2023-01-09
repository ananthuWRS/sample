<!--begin::Drawers-->

<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
	<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
	<span class="svg-icon">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
			<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
		</svg>
	</span>
	<!--end::Svg Icon-->
</div>
<!--end::Scrolltop-->
<!--begin::Javascript-->
<script>
	var hostUrl = "<?= base_url() ?>components/";
	var base_url = '<?= base_url() ?>';
</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="<?= base_url() ?>components/plugins/global/plugins.bundle.js"></script>
<script src="<?= base_url() ?>components/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="<?= base_url() ?>components/js/widgets.bundle.js"></script>
<script src="<?= base_url() ?>components/js/custom/widgets.js"></script>
<script src="<?= base_url() ?>components/js/custom/scripts/common.js"></script>
<!--end::Javascript-->


<?php
if (!empty($externalscript)) {
	foreach ($externalscript as $key => $value) {
?>
		<script src="<?= $value ?>"></script>
	<?php
	}
}
if (!empty($vendorjs)) {
	foreach ($vendorjs as $value) {
	?>
		<script src="<?= base_url() ?>components/plugins/<?= $value ?>?v=<?php echo getversion() ?>"></script>
	<?php

	}
}
if (!empty($commonjs)) {
	foreach ($commonjs as $value) {
	?>
		<script src="<?= base_url() ?>components/js/<?= $value ?>?v=<?php echo getversion() ?>"></script>
<?php

	}
}
if (!empty($scriptfunctions)) {
	echo '<script type="text/javascript">';
	echo "$(document).ready(function() {";

	foreach ($scriptfunctions as $value) {

		echo $value;
	}

	echo " });";
	echo "</script>";
}

if (!empty($scriptnonloadfunctions)) {
	echo '<script type="text/javascript">';

	foreach ($scriptnonloadfunctions as $value) {

		echo $value;
	}

	echo "</script>";
}
?>
<?php if ($this->session->flashdata('successmessage') || $this->session->flashdata('errormessage')) {
?>
	<script type="text/javascript">
		$(document).ready(function() {
			toastr.options = {
				"closeButton": true,
				"debug": false,
				"newestOnTop": false,
				"progressBar": true,
				"positionClass": "toastr-top-right",
				"preventDuplicates": true,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "linear",
				"hideEasing": "linear",
				"showMethod": "show",
				"hideMethod": "fadeOut"
			};
			<?php if ($this->session->flashdata('successmessage')) { ?>
				toastr.success('<?php echo $this->session->flashdata('successmessage'); ?>');
			<?php } ?>
			<?php if ($this->session->flashdata('errormessage')) { ?>
				toastr.error('<?php echo $this->session->flashdata('errormessage'); ?>');
			<?php } ?>

		});
	</script>
<?php } ?>
<?php
if ($this->session->userdata('usertype') != 1 && ($this->reportingPerson <= 0)) {
?>
	<script>
		
		
		
		var now = new Date();
		var timeminute =0;
		//console.log(now.getHours());
		//console.log(now.getMinutes());
		if(now.getHours()>=9 && now.getHours()<=10){
			//console.log(now.getHours() +"time")
		}
		var millisTill102 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 16, 0, 0, 0) - now;
		if (millisTill102 < 0) {
			millisTill102 += 86400000; //24 Hours (hrs)
		}

		//console.log(millisTill10);
		setTimeout(function() {

			Swal.fire({
				title: 'Please submit your work report.',
				icon: "success",
				icon: 'warning',
				didOpen: () => {
					$('audio#myAudio')[0].play();

				},
				didClose: () => {
					$('audio#myAudio')[0].pause();
				}
			}, )
		}, millisTill102);

		var millisTill10 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 17, 0, 0, 0) - now;
		if (millisTill10 < 0) {
			millisTill10 += 86400000; //24 Hours (hrs)
		}

		//console.log(millisTill10);
		setTimeout(function() {

			Swal.fire({
				title: 'Please submit your work report.',
				icon: "success",
				icon: 'warning',
				didOpen: () => {
					$('audio#myAudio')[0].play();

				},
				didClose: () => {
					$('audio#myAudio')[0].pause();
				}
			}, )
		}, millisTill10);
	</script>
<?php
}




?>
<script src="http://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js"></script>

<script>
	$(document).ready(function(){
		$('.cloclSpan').attr('data-content',':');
});
	
	
	$('audio#myAudio')[0].play();
	$('audio#myAudio')[0].pause();
	var forecedSignOutInterval;
	var ttlsnd = 0;

	var userTimeStamp = [{

	}]


	if ( /*window.localStorage.getItem("totaltime") =='object' ||*/ window.localStorage.getItem("isPaused") == "false" && parseInt(window.localStorage.getItem("totaltime")) == "NaN" || window.localStorage.getItem("totaltime") == null) {


		ttlsnd = 0;

	} else {

		ttlsnd = parseInt(window.localStorage.getItem("totaltime"));


	}

	var Clock = {
		totalSeconds: (window.localStorage.getItem("isPaused") == "false" && parseInt(window.localStorage.getItem("totaltime")) == "NaN" || window.localStorage.getItem("totaltime") == null) ? ttlsnd = 0 : ttlsnd = parseInt(window.localStorage.getItem("totaltime")),

		start: function() {
			if (window.localStorage.getItem("isPaused") == "false" || window.localStorage.getItem("isPaused") == "NaN" || window.localStorage.getItem("isPaused") == null) {
				

				var self = this;


				this.interval = setInterval(function() {

					self.totalSeconds += 1;
					window.localStorage.setItem("totaltime", self.totalSeconds);

					let hh, mm, ss;
					hh = Math.floor(self.totalSeconds / 3600);
					hh = (hh < 10) ? '0' + hh : hh;
					$("#hour").text(hh);
					mm = Math.floor(self.totalSeconds / 60 % 60)
					mm = (mm < 10) ? '0' + mm : mm;
					$("#min").text(mm);
					ss = parseInt(self.totalSeconds % 60);
					ss = (ss < 10) ? '0' + ss : ss;
					$("#sec").text(ss);

				}, 1000);
			}
		},

		pause: function() {

			const pTime = new Date(parseInt(window.localStorage.getItem("totaltime")) * 1000).toISOString().slice(11, 19);
			
			userTimeStamp.pop();
			userTimeStamp.push({
				pausedTime: pTime,
				pausedDate: new Date().toString(),
				resumeDate: 'null',
				totalBreakTime: 'null',
			})

			


			window.localStorage.setItem("isPaused", true);
			clearInterval(this.interval);
			delete this.interval;
		},

		resume: function() {

			window.localStorage.setItem("isPaused", false);

			if (!this.interval) this.start();





		}
	};


	window.localStorage.setItem("hasStarted", false);

	window.onstorage = (e) => {

		if (window.localStorage.getItem("isPaused") == "true" && (window.localStorage.getItem("isPaused") != "NaN" || window.localStorage.getItem("isPaused") != null)) {
			$('#pauseTimer').hide();
			$('#startTimer').show();
			
			clearInterval(Clock.interval);
			delete Clock.interval;
			

		} else if (window.localStorage.getItem("isPaused") == "false" && (window.localStorage.getItem("isPaused") != "NaN" || window.localStorage.getItem("isPaused") != null)) {
			
			if (window.localStorage.getItem("hasStarted") == 'true') {
				
				$('#pauseTimer').show();
				$('#startTimer').hide();
				
				if (!Clock.interval) Clock.start();

				window.localStorage.setItem("hasStarted", false);
			}

		}

	};
	if (window.localStorage.getItem("isPaused") == "NaN" || window.localStorage.getItem("isPaused") == null) {
		
		$('#startTimer').hide();
		$('#pauseTimer').show();
		Clock.start();
	} else if (window.localStorage.getItem("isPaused") == "false" && (window.localStorage.getItem("isPaused") != "NaN" || window.localStorage.getItem("isPaused") != null)) {
		
		$('#startTimer').hide();
		$('#pauseTimer').show();
		
		Clock.resume();
	} else {
		
		$('#startTimer').show();
		$('#pauseTimer').hide();
		if (ttlsnd == 0) {
			
			$("#hour").text(00);
			$("#min").text(00);
			$("#sec").text(00);
		} else {
			
			let hh, mm, ss;
			hh = Math.floor(ttlsnd / 3600);
			hh = (hh < 10) ? '0' + hh : hh;
			$("#hour").text(hh);
			mm = Math.floor(ttlsnd / 60 % 60)
			mm = (mm < 10) ? '0' + mm : mm;
			$("#min").text(mm);
			ss = parseInt(ttlsnd % 60);
			ss = (ss < 10) ? '0' + ss : ss;
			$("#sec").text(ss);
		}

	}


	$('#pauseTimer').click(function() {
		$(this).hide();
		$('#startTimer').show();
		Clock.pause();
		if ('userTime' in localStorage) {

			window.localStorage.removeItem('userTime');
			
		}

		window.localStorage.setItem("userTime", JSON.stringify(userTimeStamp));

	});
	$('#startTimer').click(function() {
		window.localStorage.setItem("hasStarted", true)

		$(this).hide();
		$('#pauseTimer').show();
		Clock.resume();
		var tempstamp = JSON.parse(window.localStorage.getItem("userTime"));
		
		tempstamp[(tempstamp.length) - 1].totalBreakTime = (new Date() - new Date(JSON.parse(window.localStorage.getItem("userTime"))[(JSON.parse(window.localStorage.getItem("userTime")).length) - 1].pausedDate));
		tempstamp[(tempstamp.length) - 1].resumeDate = new Date().toString();

		var old = JSON.parse(window.localStorage.getItem("userTimeStamp")) || [];
		

		window.localStorage.setItem("userTimeStamp", JSON.stringify(old.concat(tempstamp)));
	});

	var timeoutID;
	var timelimit = 2700000; //45 minutes//Math.floor(45 * 60 * 1000);


	function setup() {
		this.addEventListener("mousemove", resetTimer, false);
		this.addEventListener("mousedown", resetTimer, false);
		this.addEventListener("keypress", resetTimer, false);
		this.addEventListener("DOMMouseScroll", resetTimer, false);
		this.addEventListener("mousewheel", resetTimer, false);
		this.addEventListener("touchmove", resetTimer, false);
		this.addEventListener("MSPointerMove", resetTimer, false);


		startTimer();
	}
	setup();

	function startTimer() {
		
		timeoutID = window.setTimeout(goInactive, timelimit);
	}

	function resetTimer(e) {

		window.clearTimeout(timeoutID);

		goActive();
	}



	function goInactive() {
		
		if (window.localStorage.getItem("isPaused") === "true" && (window.localStorage.getItem("isPaused") != "NaN" || window.localStorage.getItem("isPaused") != null)) {
			
			resetTimer();
		} else {



			$('#pauseTimer').click();

			Swal.fire({
				title: 'You have been inactive for ' + Math.floor((timelimit / 1000 / 60) % 60) + '.',
				html: "You will be signed out in <b></b> minutes.",
				icon: "success",
				icon: 'warning',
				timer: 300000,
				timerProgressBar: true,
				didOpen: () => {
					const b = Swal.getHtmlContainer().querySelector('b')
					timerProgressBarInterval = setInterval(() => {
						b.textContent = Math.floor(( Swal.getTimerLeft() / 1000 / 60) % 60)+":"+Math.floor((Swal.getTimerLeft() / 1000) % 60) 
					}, 100)
					$('audio#myAudio')[0].play();
					forecedSignOutInterval = setTimeout(forecedSignOut, 300000);

				},

				didClose: () => {
					$('audio#myAudio')[0].pause();
					clearInterval(timerProgressBarInterval);
					clearTimeout(forecedSignOutInterval);
					
				}
			}, )


		}


	}

	function goActive() {
		
		startTimer();

	}


	function forecedSignOut() {
		$('#signOutBtn').click();
	}

	$('#signOutBtn').click(function(e) {
		var tempUserTimeStamp;
		var tempstamp;
		var old;
		if ('userTimeStamp' in localStorage) {

			if ('isPaused' in localStorage && window.localStorage.getItem('isPaused') == "true") {
				
				old = JSON.parse(window.localStorage.getItem("userTimeStamp"));
				tempUserTimeStamp = JSON.parse(window.localStorage.getItem("userTime"));
				tempUserTimeStamp = old.concat(tempUserTimeStamp);
			} else {
				
				tempUserTimeStamp = JSON.parse(window.localStorage.getItem("userTimeStamp"));
			}

		} else {
			if ('isPaused' in localStorage && window.localStorage.getItem('isPaused') == "true") {
				
				tempUserTimeStamp = JSON.parse(window.localStorage.getItem("userTime"));
			} else {
				

				tempUserTimeStamp = null;
			}
			

		}



		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '<?= base_url() ?>welcome/do_logout',
			data: {
				seconds: parseInt(window.localStorage.getItem("totaltime")),
				UserTimeStampJson: JSON.stringify(tempUserTimeStamp)
			},
			success: function(response) {
				
				Clock.pause();
				
				localStorage.clear()

				window.location.href = "<?= base_url() ?>welcome/index";

			},
			error: function() {

			}
		});
	});
</script>
<script type="text/javascript">
	// // Broadcast that you're opening a page.
	// localStorage.openpages = Date.now();
	// var onLocalStorageEvent = function(e){
	//     if(e.key == "openpages"){
	//         // Listen if anybody else is opening the same page!
	//         localStorage.page_available = Date.now();
	//     }
	//     if(e.key == "page_available"){
	//         alert("One more page already open");
	//     }
	// };
	// var dfg =function(e){
	// 	alert("fdgdf");
	// }
	// window.addEventListener('storage', onLocalStorageEvent,dfg, false);
</script>
