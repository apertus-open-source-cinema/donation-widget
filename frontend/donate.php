<?php
require_once 'functions.php';
require_once 'meekrodb.2.1.class.php';

// MYSQL DB
DB::$user 		= 'MYSQL-USERNAME';
DB::$password 	= 'MYSQL-PASSWORD';
DB::$dbName 	= 'MYSQL-DATABASENAME';

// target amounts to raise
$target_axiom = 18000;
$target_opencine = 14000;
$target_dictator = 6000;
$target_website = 1000;
$target_hollywood = 5000;

?>
<meta http-equiv='X-UA-Compatible' content='IE=EmulateIE8,chrome=1' />
<meta charset="utf-8">
	<style>
	.bignumber {
		font-size:2em;
		padding-left:10px;
	}
	.slider{
		width: 430px;
		display: inline-block;
		height:4px;
		top: 12px;
	}
	.notice { display:inline; font-size:0.7em; margin-left:10px; }
	.reward { display:inline; font-size:0.7em; margin-left:10px; }
	.errornotice { padding-left:10px; display:inline; font-size:0.7em; color:#ff0000; }
	.slider .ui-slider-range { background: #343647; }
	.slider .ui-slider-handle { 
		width: 10px;
		height:10px;
		background-color: #15172c; 
	}
	.amount_field {
		background-color:#ebebeb;
		border: 1px solid #999999;
		-moz-border-radius:3px;
		-webkit-border-radius: 3px;
		-khtml-border-radius: 3px;
		border-radius: 3px;
		margin-left:10px;
		margin-top:2px;
		margin-bottom:2px;
		padding:3px;
		width:60px;
		text-align:right;
		position: relative;
		bottom: 15px;
	}
	.amount_label {
		padding:5px;
		position: relative;
		bottom: 13px;
	}
	.dnt_target {
		float:right;
		padding-left:10px;
		font-weight:bold;
	}
	.gold-logo {
		border: 1px solid #ccc;
		margin-bottom:10px;
	}
	</style>
</meta>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.23/themes/base/jquery-ui.css" type="text/css" media="all" />

<div class="alert alert-info">
	Please note that this is a donation fundraising campaign and NOT the crowd funding campaign we will run for Axiom. The Axiom crowd funding campaign will be announced separately.
</div>
<div class="alert alert-error" id="javascript-enable">
	<b>This donation page requires Javascript to be enabled. It won't work properly without!</b>
</div>

<?php
	echo "<div class=\"well\">";
	echo "We received <b>".GetNumberOfDonations()." donations</b> with a total amount of: <b>".GetTotalDonations()." €</b>";
	
	echo "<hr />";
	echo "<div class=\"dnt_line\"><div class=\"dnt_name\">Apertus Axiom Alpha Prototype</div><div class=\"dnt_target\">".$target_axiom." €</div>";
	$width = GetTotalDonationsSubproject(0, false)*100/$target_axiom;
	if ($width < 7)
		$width = 7;
	echo "<div class=\"progress progress-info\"><div class=\"bar\" style=\"width: ".$width."%\">".GetTotalDonationsSubproject(0)." €</div></div>";
	echo "</div><br />";
	
	echo "<div class=\"dnt_line\"><div class=\"dnt_name\">Open Cine - free RAW processing suite</div><div class=\"dnt_target\">".$target_opencine." €</div>";
	$width = GetTotalDonationsSubproject(1, false)*100/$target_opencine;
	if ($width < 7)
		$width = 7;
	echo "<div class=\"progress progress-info\"><div class=\"bar\" style=\"width: ".$width."%\">".GetTotalDonationsSubproject(1)." €</div></div>";
	echo "</div><br />";
	
	echo "<div class=\"dnt_line\"><div class=\"dnt_name\">Dictator Interface</div><div class=\"dnt_target\">".$target_dictator." €</div>";
	$width = GetTotalDonationsSubproject(2, false)*100/$target_dictator;
	if ($width < 7)
		$width = 7;
	echo "<div class=\"progress progress-info\"><div class=\"bar\" style=\"width: ".$width."%\">".GetTotalDonationsSubproject(2)." €</div></div>";
	echo "</div><br />";
	
	echo "<div class=\"dnt_line\"><div class=\"dnt_name\">Website Hosting and Domain Fees</div><div class=\"dnt_target\">".$target_website." €</div>";
	$width = GetTotalDonationsSubproject(3, false)*100/$target_website;
	if ($width < 7)
		$width = 7;
	echo "<div class=\"progress progress-info\"><div class=\"bar\" style=\"width: ".$width."%\">".GetTotalDonationsSubproject(3)." €</div></div>";
	echo "</div><br />";
	
	echo "<div class=\"dnt_line\"><div class=\"dnt_name\">\"Hollywood loves Open Source\" documentary</div><div class=\"dnt_target\">".$target_hollywood." €</div>";	
	$width = GetTotalDonationsSubproject(4, false)*100/$target_hollywood;
	if ($width < 7)
		$width = 7;
	echo "<div class=\"progress progress-info\"><div class=\"bar\" style=\"width: ".$width."%\">".GetTotalDonationsSubproject(4)." €</div></div>";
	echo "</div><br />";
	
	echo "<div class=\"dnt_line\"><div class=\"dnt_name\">Miscellaneous</div><div class=\"dnt_amount\">".GetTotalDonationsSubproject(5)." €</div>";	
	echo "</div><br />";
	
	echo "</div>"; 
?>
<div class="row-fluid">
	<div class="span6">
		<div class="well">
			<h4>Official Apertus Supporters</h4>
			<h1>Gold</h1>
			<a href="#logos"><img src="/img/500x150your_logo_here.jpg"></a><br /><br />
			<? 
			foreach(GetDonators(100,9999999) as $donator) {
				if ($donator['logo_url'] != "") {
					echo "<a href=\"".$donator['nick_url']."\" target=\"_blank\"><img class=\"gold-logo\" src=\"".$donator['logo_url']."\"></a><br />";
				} if ($donator['nick'] != "") {
					echo "<div class=\"dnt_line\">";
					echo "<div class=\"dnt_name\">".ReplaceTwitter($donator['nick'])."</div>";
					echo "<div class=\"dnt_amount\">".$donator['donation_amount']." €</div>";
					echo "</div>";
				}
			}
			?>
			<br /><br />
			<h2>Silver</h2>
			<a href="#logos"><img src="/img/200x80your_logo_here.jpg"></a><br /><br />
			<? 
			foreach(GetDonators(50, 99.99) as $donator) {
				if ($donator['nick'] != "") {
					echo "<div class=\"dnt_line\">";
					echo "<div class=\"dnt_name\">".ReplaceTwitter($donator['nick'])."</div>";
					echo "<div class=\"dnt_amount\">".$donator['donation_amount']." €</div>";
					echo "</div>";
				}
			}
			?>
			<br /><br />
			<h3>Bronze</h3>
			<?
			foreach(GetDonators(25, 49.99) as $donator) {
				if ($donator['nick'] != "") {
					echo "<div class=\"dnt_line\">";
					echo "<div class=\"dnt_name\">".ReplaceTwitter($donator['nick'])."</div>";
					echo "<div class=\"dnt_amount\">".$donator['donation_amount']." €</div>";
					echo "</div>";
				}
			}
			?>
			<br /><br />
			<h4>Regular Donators</h4>
			<?
			foreach(GetDonators(0, 24.99) as $donator) {
				if ($donator['nick'] != "") {
					echo "<div class=\"dnt_line\">";
					echo "<div class=\"dnt_name\">".ReplaceTwitter($donator['nick'])."</div>";
					echo "<div class=\"dnt_amount\">".$donator['donation_amount']." €</div>";
					echo "</div>";
				}
			}
			?>
		</div>
	</div>
	<div class="span6">
		<h1>Donate</h1>
		<div class="bignumber">1.</div>
		Choose donation type:<br />
		<input type="radio" name="donation_freq" value="once" checked> Donate Once<br />
		<input type="radio" name="donation_freq" value="subscription"> Monthly Subscription 
		<div id="SubscriptionHolder" style="display:none;">
			<div class="notice">You can cancel the subscription at any time</div>
		</div>
		<div class="bignumber">2.</div>
		Donate money, in EUR:<br />
		<a name="logos"></a>
		<input type="radio" name="donation_amount" value="100"> 100.00 €<div class="reward">Gold: Your logo (500x150 pixels with link) on top of official list of Apertus supporters</div><br />
		<input type="radio" name="donation_amount" value="50" > 50.00 €<div class="reward">Silver: Your logo (200x80 pixels with link) on official list of Apertus supporters</div><br />
		<input type="radio" name="donation_amount" value="25" checked> 25.00 €<div class="reward">Bronze: Your name on official list of Bronze Apertus supporters</div><br />
		<input type="radio" name="donation_amount" value="15"> 15.00 €<br />
		<input type="radio" name="donation_amount" id="custom_amount" value="custom"> Custom amount: 
		<div id="customAmountHolder" style="display:none;">
			<input class="amount_field" style="bottom:1px;" id="customAmount" type="text" placeholders="20" name="customAmount" maxlength="15" value="10"> € <div class="notice">Please enter the amount in a format like 10, 20.50, or 100.00</div>
		</div>
		<div class="bignumber">3.</div>
		Choose how you would like to divide up your contribution (click on the projects to learn more about how the money will be spent):<br /><br />
		<div>
			<a href="#" data-toggle="collapse" data-target="#collapse_alpha" class="slider-label"><i class="icon-info-sign" style="margin-top:2px;"></i> Axiom Alpha (Prototype)</a>
			<div class="slider" id="divide_axiom"></div>
			<input class="amount_field" id="amount_axiom" type="text" placeholders="20" maxlength="15"><span class="amount_label">€</span>
			<div class="collapse" id="collapse_alpha">
				<div class="well">
					<img src="img/alpha-lensmount01.jpg" style="padding-bottom:20px;"><br />
					While the essential parts (electronics, prototyping services, etc.) of <a href="index.php?site=alpha" target="_blank">Apertus Axiom Alpha</a> are funded through our partners and the Apertus Association there is one major 
					difference that additional funds will make: Speed.<br /> 
					The Apertus team is working on the Alpha prototype in their free time after coming home from their normal dayjobs - so progress is made but at a rather slow speed. 
					Any money contribution to Apertus Alpha will increase the amount of time the team can spend on development compensating them for the time they are not at their day job.
					<br />
				</div>
			</div>
		</div>

		<div>
			<a href="#" data-toggle="collapse" data-target="#collapse_opencine" class="slider-label"><i class="icon-info-sign" style="margin-top:2px;"></i> Open Cine - free RAW processing suite</a>
			<div class="slider" id="divide_opencine"></div> 
			<input class="amount_field" id="amount_opencine" type="text" placeholders="20" maxlength="15"><span class="amount_label">€</span>
			<div class="collapse" id="collapse_opencine">
				<div class="well">
					<img src="http://apertus.org/sites/default/files/JP4ToolsGUI_05.jpg" style="margin-bottom:20px;"><br />
					Unfortunately there is no software developers working on the development of the only free raw motion picture footage development/processing suite <a target="_blank" href="http://apertus.org/opencine">Open Cine</a> yet.<br />
					It is intended to work with raw footage from pretty much any camera vendor so this software is not Axiom specific.<br />
					<br />
					But without money to pay a software developer this software is going no where.<br />
					You can help change that.<br />
				</div>
			</div>
		</div>

		<div>
			<a href="#" data-toggle="collapse" data-target="#collapse_dictator" class="slider-label"><i class="icon-info-sign" style="margin-top:2px;"></i> Dictator Interface</a>
			<div class="slider" id="divide_dictator"></div> 
			<input class="amount_field" id="amount_dictator" type="text" placeholders="20" maxlength="15"><span class="amount_label">€</span>
			<div class="collapse" id="collapse_dictator">
				<div class="well">
					<img src="http://apertus.org/sites/default/files/dictatorIIconcept04.jpg" style="margin-bottom:20px;">
					To develop the <a href="http://apertus.org/dictator" target="_blank">Dictator</a> from a concept to an actual device we need to pay a hardware/PCB designer. These guys are not cheap, but since the device is rather simple from the required electronic components
					we will be able to do it with around 6,000 €. We have the people to take care of the rest (without getting paid) - though manufacturing will still cost money to finish the remaining steps to a fully 
					functional working device but this prototyping cost is already included in the 6,000 €.
				</div>
			</div>
		</div>

		<div>
			<a href="#" data-toggle="collapse" data-target="#collapse_website" class="slider-label"><i class="icon-info-sign" style="margin-top:2px;"></i> Website Hosting and Domain Fees</a>
			<div class="slider" id="divide_website"></div> 
			<input class="amount_field" id="amount_website" type="text" placeholders="20" maxlength="15"><span class="amount_label">€</span>
			<div class="collapse" id="collapse_website">
				<div class="well">
					Apertus members already paid website hosting and domain fees for several years privately without anyone ever asking. Donate some money here to make sure we can afford this in the future without 
					paying it from our members own pockets anymore.
				</div>
			</div>
		</div>

		<div>
			<a href="#" data-toggle="collapse" data-target="#collapse_hollywood" class="slider-label"><i class="icon-info-sign" style="margin-top:2px;"></i> "Hollywood loves Open Source" documentary film</a>
			<div class="slider" id="divide_hollywood"></div> 
			<input class="amount_field" id="amount_hollywood" type="text" placeholders="20" maxlength="15"><span class="amount_label">€</span>
			<div class="collapse" id="collapse_hollywood">
				<div class="well">
				
					<img src="img/bob_primes.jpg" style="margin-bottom:20px;"><br />
					Help us cover travel expenses or gear rental for the <a target="_blank" href="http://apertus.org/hollywood">"Hollywood loves Open Source" documentary film</a>. Which will be released under the creative commons for everyone.
					We already shot several interviews all around the world	but no crew member received any salary for doing this yet. 
					We want to offer these dedicated people at least compensation for their travel expenses for now. But our own philosophy is "fair labor", so we cannot continue to exploit these people without offering any payments forever.
					We need money to continue producing this film.
				</div>
			</div>
		</div>

		<div>
			<a href="#" data-toggle="collapse" data-target="#collapse_misc" class="slider-label"><i class="icon-info-sign" style="margin-top:2px;"></i> Let Apertus decide</a>
			<div class="slider" id="divide_misc"></div> 
			<input class="amount_field" id="amount_misc" type="text" placeholders="20" maxlength="15"><span class="amount_label">€</span>
			<div class="collapse" id="collapse_misc">
				<div class="well">
					With money in this pot you give us the responsibility to decide on our own what Apertus project we think needs the most monetary attention at the moment.
				</div>
			</div>
		</div>

		<!--Sum: <input class="amount_field" id="sum" type="text" placeholders="20" maxlength="15"> <input class="amount_field" id="sum_dec" type="text" placeholders="20" maxlength="15">-->
		<div class="bignumber">4.</div>
		Enter your email address (please double check): 
		<br />
		<input class="email_field" id="email" type="text" size="60">
		<div id="EmailErrorHolder" style="display:none;">
			<div class="errornotice">Please enter a valid email address.</div>
		</div><br />
		<input id="newsletter" type="checkbox" checked> Subscribe to Apertus newsletter (to learn what we achieved with your money)?<br />

		<div class="bignumber">5.</div>
		Enter your nickname:<br />
		<input class="nick_field" id="nick" type="text" size="60">
		<ul>
			<li>your nickname will be displayed together with donation amount in donator list</li>
			<li>leave blank if you don't want to be listed</li>
			<li>use "@" at beginning for twitter nickname - will link to your twitter profile automatically</li>
			<li>if you are a Gold or Silver donator please email logo/website URL to *email-removed* or we will get in touch with you via the email address you provided</li>
		</ul>

		<div class="bignumber">6.</div>
		Finish Donation:<br />
		<br />
		<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypal_form">
			<input type="hidden" id="paypal_xclick" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="your_paypal@address.com">
			<input type="hidden" name="LC" value="US">
			<input type="hidden" name="lc" value="US">
			<input type="hidden" name="country" value="US"> 
			<input type="hidden" name="currency_code" value="EUR">
			<input type="hidden" name="item_name" value="Donate to Apertus Association">
			<input type="hidden" name="custom" id="paypal_donate_custom" value="...">
			<input type="hidden" name="amount" id="paypal_donate_amount" value="9.99">
			<input type="hidden" id="a3" name="a3" value="5.00">
			<input type="hidden" id="p3" name="p3" value="1">
			<input type="hidden" id="t3" name="t3" value="M">
			<input type="hidden" name="src" value="1">
			<input type="hidden" name="notify_url" value="URL_TO_YOUR_IPN_FILE">
			<input type="image" src="http://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" 
				border="0" name="submit" alt="Donate with PayPal">
		</form>
		<div id="ErrorHolder" style="display:none;">
			<div class="errornotice">You did not fill out all required fields.</div>
		</div>
		<hr />
		<span style="font-size:0.8em;">If there is any problem or you need assistance with the donation process please email us at: <br />*EMAIL-REMOVED*</span>
	</div>
</div>
	<script>
	var total_donation = 0;
	var AxiomSlider_LastValue = 0;
	var OpenCineSlider_LastValue = 0;
	var DictatorSlider_LastValue = 0;
	var WebsiteSlider_LastValue = 0;
	var HollywoodSlider_LastValue = 0;
	var MiscSlider_LastValue = 0;
	var AxiomRatioStart = 0;
	var OpenCineRatioStart = 0;
	var WebsiteRatioStart = 0;
	var DictatorRatioStart = 0;
	var HollywoodRatioStart = 0;
	var MiscRatioStart = 0;
	var Sliding_Index = 0;
	var Slider_Boundary_Margin = 2000;
	var correct_error_now = false;
	
	$(document).ready(function() {
		// remove javascript warning if javascript is present
		$("#javascript-enable").css("display", "none");
		
		//init
		if ($("input:radio[name='donation_amount']:checked").val() == 'custom') {
			$('#customAmountHolder').fadeIn('fast').css("display","inline-block");
			if (/^\d+$/.test($('#customAmount').val())) {
				total_donation = Math.round((parseInt($('#customAmount').val()) * 100) / 100);
			} else {
				total_donation = 1;
			}
		} else {
			$('#customAmountHolder').fadeOut('fast');
			total_donation = Math.round(parseInt($("input:radio[name='donation_amount']:checked").val() * 100) / 100);
		} 
		if ($("input:radio[name='donation_freq']:checked").val() == 'subscription') {
			$('#SubscriptionHolder').fadeIn('fast').css("display","inline-block");
		} else {
			$('#SubscriptionHolder').fadeOut('fast');
		}
		setInterval("UpdateAmounts()", 100); // this needs to be delayed to work properly
		
			
		//event handler
		$("input:radio[name='donation_freq']").live('change',function(event) {
			if ($("input:radio[name='donation_freq']:checked").val() == 'subscription') {
				$('#SubscriptionHolder').fadeIn('fast').css("display","inline-block");
			} else {
				$('#SubscriptionHolder').fadeOut('fast');
			}  
		});
		$("input:radio[name='donation_amount']").live('change',function(event) {
			if ($("input:radio[name='donation_amount']:checked").val() == 'custom') {
				$('#customAmountHolder').fadeIn('fast').css("display","inline-block");
				if (/^\d+$/.test($('#customAmount').val())) {
					total_donation = Math.round((parseInt($('#customAmount').val()) * 100) / 100);
				} else {
					total_donation = 1;
				}
			} else {
				$('#customAmountHolder').fadeOut('fast');
				total_donation = Math.round(parseInt($("input:radio[name='donation_amount']:checked").val() * 100) / 100);
			}  
			UpdateAmounts();
		});  
		$("input#customAmount").keyup(function() {
			if (/^\d+$/.test($('#customAmount').val())) {
				total_donation = Math.round((parseInt($('#customAmount').val()) * 100) / 100);
			} else {
				total_donation = 1;
			}
			UpdateAmounts();
		});  
		
		$("#paypal_form").submit(function(override) {
			override = typeof override !== 'undefined' ? override : false;
			return ValidateInput();
		});
		
		$('a.slider-label').click(function(e) {
			// Prevent collapse links to make the page jump to the top
			// Cancel the default action
			e.preventDefault();
		});

		// Run error correction on init
		Sliding_Index == 0
		correct_error_now = true;
		CorrectRoundingError();
	});

	function UpdateAmounts() {
		if (isNaN(total_donation)) {
			total_donation = 1;
		}
		
		$('#amount_axiom').val((Math.round(GetSliderValue("divide_axiom")/100000 * total_donation * 100) / 100).toFixed(2));
		$('#amount_opencine').val((Math.round(GetSliderValue("divide_opencine")/100000 * total_donation * 100) / 100).toFixed(2));
		$('#amount_dictator').val((Math.round(GetSliderValue("divide_dictator")/100000 * total_donation * 100) / 100).toFixed(2));
		$('#amount_website').val((Math.round(GetSliderValue("divide_website")/100000 * total_donation * 100) / 100).toFixed(2));
		$('#amount_hollywood').val((Math.round(GetSliderValue("divide_hollywood")/100000 * total_donation * 100) / 100).toFixed(2));
		$('#amount_misc').val((Math.round(GetSliderValue("divide_misc")/100000 * total_donation * 100) / 100).toFixed(2));
		
		var sum = parseFloat($('#amount_axiom').val()) + parseFloat($('#amount_opencine').val()) + parseFloat($('#amount_dictator').val()) + 
					parseFloat($('#amount_website').val()) + parseFloat($('#amount_hollywood').val()) + parseFloat($('#amount_misc').val());
		$('#sum').val(sum);
		var sum_dec = parseFloat((GetSliderValue("divide_axiom")/100000 * total_donation) + (GetSliderValue("divide_opencine")/100000 * total_donation) + 
		(GetSliderValue("divide_dictator")/100000 * total_donation) + (GetSliderValue("divide_website")/100000 * total_donation) + (GetSliderValue("divide_hollywood")/100000 * total_donation) +
		(GetSliderValue("divide_misc")/100000 * total_donation));
		$('#sum_dec').val(sum_dec);
		
		
		// update donate widgets
		$('#paypal_donate_amount').val(total_donation);
		var custom_string = 
		"email=" + $('#email').val() + 
		"&divide_axiom=" + $('#amount_axiom').val() + 
		"&divide_opencine=" + $('#amount_opencine').val() + 
		"&divide_dictator=" + $('#amount_dictator').val() + 
		"&divide_website=" + $('#amount_website').val() + 
		"&divide_hollywood=" + $('#amount_hollywood').val() + 
		"&divide_misc=" + $('#amount_misc').val() + 
		"&nick=" + $('#nick').val() + 
		"&donation_freq=" + $("input:radio[name='donation_freq']:checked").val();
		$('#paypal_donate_custom').val(custom_string);

		if ($("input:radio[name='donation_freq']:checked").val() == "subscription") {
			$('#paypal_xclick').val("_xclick-subscriptions");
			$('#a3').val(total_donation);
			$('#p3').val("1");
			$('#t3').val("M");
		} else {
			$('#paypal_xclick').val("_xclick");
		}
	}
	
	function GetNumberSlidersZero() {
		var factor = 0;
		
		if (GetSliderValue("divide_axiom") == 0 ) {
			factor += 1; 
		}
		if (GetSliderValue("divide_dictator") == 0 ) {
			factor += 1;
		}
		if (GetSliderValue("divide_opencine") == 0 ) {
			factor += 1;
		}
		if (GetSliderValue("divide_website") == 0 ) {
			factor += 1;
		}
		if (GetSliderValue("divide_hollywood") == 0 ) {
			factor += 1;
		}
		if (GetSliderValue("divide_misc") == 0 ) {
			factor += 1;
		}
		return factor;
	}
	
	function GetNumberOfSliders() {
		return 6;
	}
	
	function CorrectRoundingError() {
		if ((Sliding_Index == 0) && correct_error_now) {
			var corrected = total_donation - (parseFloat($('#amount_opencine').val()) + parseFloat($('#amount_website').val())
											+ parseFloat($('#amount_misc').val()) + parseFloat($('#amount_hollywood').val()) + parseFloat($('#amount_dictator').val()));
			//console.log('corrected is: ' + corrected);
			correct_error_now = false;
			Sliding_Index = -1;

			SetSliderValue("divide_axiom", Math.round(corrected / total_donation * 100000));
			//console.log('Slider is: ' + GetSliderValue("divide_axiom") * total_donation / 100000);
		}
		if ((Sliding_Index == 1) && correct_error_now) {
			var corrected = total_donation - (parseFloat($('#amount_axiom').val()) + parseFloat($('#amount_website').val())
											+ parseFloat($('#amount_misc').val()) + parseFloat($('#amount_hollywood').val()) + parseFloat($('#amount_dictator').val()));
			//console.log('corrected is: ' + corrected);
			correct_error_now = false;
			Sliding_Index = -1;

			SetSliderValue("divide_opencine", Math.round(corrected / total_donation * 100000));
			//console.log('Slider is: ' + GetSliderValue("divide_axiom") * total_donation / 100000);
		}
		if ((Sliding_Index == 2) && correct_error_now) {
			var corrected = total_donation - (parseFloat($('#amount_axiom').val()) + parseFloat($('#amount_website').val())
											+ parseFloat($('#amount_misc').val()) + parseFloat($('#amount_hollywood').val()) + parseFloat($('#amount_opencine').val()));
			//console.log('corrected is: ' + corrected);
			correct_error_now = false;
			Sliding_Index = -1;

			SetSliderValue("amount_dictator", Math.round(corrected / total_donation * 100000));
			//console.log('Slider is: ' + GetSliderValue("divide_axiom") * total_donation / 100000);
		}
		if ((Sliding_Index == 3) && correct_error_now) {
			var corrected = total_donation - (parseFloat($('#amount_axiom').val()) + parseFloat($('#divide_opencine').val())
											+ parseFloat($('#amount_misc').val()) + parseFloat($('#amount_hollywood').val()) + parseFloat($('#amount_dictator').val()));
			//console.log('corrected is: ' + corrected);
			correct_error_now = false;
			Sliding_Index = -1;

			SetSliderValue("amount_website", Math.round(corrected / total_donation * 100000));
			//console.log('Slider is: ' + GetSliderValue("divide_axiom") * total_donation / 100000);
		}
		if ((Sliding_Index == 4) && correct_error_now) {
			var corrected = total_donation - (parseFloat($('#amount_axiom').val()) + parseFloat($('#amount_website').val())
											+ parseFloat($('#amount_misc').val()) + parseFloat($('#divide_opencine').val()) + parseFloat($('#amount_dictator').val()));
			//console.log('corrected is: ' + corrected);
			correct_error_now = false;
			Sliding_Index = -1;

			SetSliderValue("amount_hollywood", Math.round(corrected / total_donation * 100000));
			//console.log('Slider is: ' + GetSliderValue("divide_axiom") * total_donation / 100000);
		}
		if ((Sliding_Index == 5) && correct_error_now) {
			var corrected = total_donation - (parseFloat($('#amount_axiom').val()) + parseFloat($('#amount_website').val())
											+ parseFloat($('#divide_opencine').val()) + parseFloat($('#amount_hollywood').val()) + parseFloat($('#amount_dictator').val()));
			//console.log('corrected is: ' + corrected);
			correct_error_now = false;
			Sliding_Index = -1;

			SetSliderValue("amount_misc", Math.round(corrected / total_donation * 100000));
			//console.log('Slider is: ' + GetSliderValue("divide_axiom") * total_donation / 100000);
		}		
		
	}
	
	function GetSliderValue(slider) {
		var slider_amount_processed;
		if ($('#'+slider).slider("value") > ($('#'+slider).slider("option", "max") - Slider_Boundary_Margin)) {
			slider_amount_processed = $('#'+slider).slider("option", "max");
		} else if ($('#'+slider).slider("value") < Slider_Boundary_Margin) {
			slider_amount_processed = 0;
		} else {
			slider_amount_processed = Math.round((parseFloat($('#'+slider).slider("value")) * (1/parseFloat(($('#'+slider).slider("option", "max")))*100000) - Slider_Boundary_Margin));
		}
		return parseInt(slider_amount_processed);
	}
	
	function SetSliderValue(Slider, value) {
		var tempvalue = Math.round((parseFloat(value) / (1/(parseFloat($('#'+Slider).slider("option", "max")))*100000)) + Slider_Boundary_Margin);
		//console.log('SetSliderValue Corrected: ' + Slider + " " + tempvalue);
		$('#'+Slider).slider("value", tempvalue);
		//console.log('SetSliderValue after setting is: ' + $('#'+Slider).slider("value"));
	}
	
	function UpdateAxiomSlider() {
		if (Sliding_Index == 0) {
			var remaining_amount = $('#divide_axiom').slider("option", "max") - GetSliderValue("divide_axiom");
			
			//Update other sliders
			var value = 0;
			var unlockzero = (GetNumberSlidersZero() >= 5);
			if (($('#divide_opencine').slider("value") != 0) || unlockzero) {
				value = remaining_amount * OpenCineRatioStart;
				SetSliderValue('divide_opencine', value);
			}
			if (($('#divide_dictator').slider("value") != 0) || unlockzero) {
				value = DictatorRatioStart * remaining_amount;
				SetSliderValue('divide_dictator', value);
			}
			if (($('#divide_website').slider("value") != 0) || unlockzero) {
				value = WebsiteRatioStart * remaining_amount;
				SetSliderValue('divide_website', value);
			}
			if (($('#divide_hollywood').slider("value") != 0) || unlockzero) {
				value = HollywoodRatioStart * remaining_amount;
				SetSliderValue('divide_hollywood', value);
			}
			if (($('#divide_misc').slider("value") != 0) || unlockzero) {
				value = MiscRatioStart * remaining_amount;
				SetSliderValue('divide_misc', value);
			}
			
			UpdateAmounts();
			if (correct_error_now)
				CorrectRoundingError();
			UpdateAmounts();
		}
	}

	function UpdateOpenCineSlider() {
		if (Sliding_Index == 1) {
			var remaining_amount = $('#divide_opencine').slider("option", "max") - GetSliderValue("divide_opencine");
			
			//Update other sliders
			var value = 0;
			var unlockzero = (GetNumberSlidersZero() >= 5);
			if (($('#divide_axiom').slider("value") != 0) || unlockzero) {
				value = remaining_amount * AxiomRatioStart;
				SetSliderValue('divide_axiom', value);
			}
			if (($('#divide_dictator').slider("value") != 0) || unlockzero) {
				value = DictatorRatioStart * remaining_amount;
				SetSliderValue('divide_dictator', value);
			}
			if (($('#divide_website').slider("value") != 0) || unlockzero) {
				value = WebsiteRatioStart * remaining_amount;
				SetSliderValue('divide_website', value);
			}
			if (($('#divide_hollywood').slider("value") != 0) || unlockzero) {
				value = HollywoodRatioStart * remaining_amount;
				SetSliderValue('divide_hollywood', value);
			}
			if (($('#divide_misc').slider("value") != 0) || unlockzero) {
				value = MiscRatioStart * remaining_amount;
				SetSliderValue('divide_misc', value);
			}
			
			UpdateAmounts();
			if (correct_error_now)
				CorrectRoundingError();
			UpdateAmounts();
		}
	}
	
	function UpdateDictatorSlider() {
		if (Sliding_Index == 2) {
			var remaining_amount = $('#divide_dictator').slider("option", "max") - GetSliderValue("divide_dictator");
			
			//Update other sliders
			var value = 0;
			var unlockzero = (GetNumberSlidersZero() >= 5);
			if (($('#divide_axiom').slider("value") != 0) || unlockzero) {
				value = remaining_amount * AxiomRatioStart;
				SetSliderValue('divide_axiom', value);
			}
			if (($('#divide_opencine').slider("value") != 0) || unlockzero) {
				value = remaining_amount * OpenCineRatioStart;
				SetSliderValue('divide_opencine', value);
			}
			if (($('#divide_website').slider("value") != 0) || unlockzero) {
				value = WebsiteRatioStart * remaining_amount;
				SetSliderValue('divide_website', value);
			}
			if (($('#divide_hollywood').slider("value") != 0) || unlockzero) {
				value = HollywoodRatioStart * remaining_amount;
				SetSliderValue('divide_hollywood', value);
			}
			if (($('#divide_misc').slider("value") != 0) || unlockzero) {
				value = MiscRatioStart * remaining_amount;
				SetSliderValue('divide_misc', value);
			}
			
			UpdateAmounts();
			if (correct_error_now)
				CorrectRoundingError();
			UpdateAmounts();
		}
	}
	
	function UpdateWebsiteSlider() {
		if (Sliding_Index == 3) {
			var remaining_amount = $('#divide_website').slider("option", "max") - GetSliderValue("divide_website");
			
			//Update other sliders
			var value = 0;
			var unlockzero = (GetNumberSlidersZero() >= 5);
			if (($('#divide_axiom').slider("value") != 0) || unlockzero) {
				value = remaining_amount * AxiomRatioStart;
				SetSliderValue('divide_axiom', value);
			}
			if (($('#divide_opencine').slider("value") != 0) || unlockzero) {
				value = remaining_amount * OpenCineRatioStart;
				SetSliderValue('divide_opencine', value);
			}
			if (($('#divide_dictator').slider("value") != 0) || unlockzero) {
				value = DictatorRatioStart * remaining_amount;
				SetSliderValue('divide_dictator', value);
			}
			if (($('#divide_hollywood').slider("value") != 0) || unlockzero) {
				value = HollywoodRatioStart * remaining_amount;
				SetSliderValue('divide_hollywood', value);
			}
			if (($('#divide_misc').slider("value") != 0) || unlockzero) {
				value = MiscRatioStart * remaining_amount;
				SetSliderValue('divide_misc', value);
			}
			
			UpdateAmounts();
			if (correct_error_now)
				CorrectRoundingError();
			UpdateAmounts();
		}
	}
	
	function UpdateHollywoodSlider() {
		if (Sliding_Index == 4) {
			var remaining_amount = $('#divide_hollywood').slider("option", "max") - GetSliderValue("divide_hollywood");
			
			//Update other sliders
			var value = 0;
			var unlockzero = (GetNumberSlidersZero() >= 5);
			if (($('#divide_axiom').slider("value") != 0) || unlockzero) {
				value = remaining_amount * AxiomRatioStart;
				SetSliderValue('divide_axiom', value);
			}
			if (($('#divide_opencine').slider("value") != 0) || unlockzero) {
				value = remaining_amount * OpenCineRatioStart;
				SetSliderValue('divide_opencine', value);
			}
			if (($('#divide_dictator').slider("value") != 0) || unlockzero) {
				value = DictatorRatioStart * remaining_amount;
				SetSliderValue('divide_dictator', value);
			}
			if (($('#divide_website').slider("value") != 0) || unlockzero) {
				value = WebsiteRatioStart * remaining_amount;
				SetSliderValue('divide_website', value);
			}
			if (($('#divide_misc').slider("value") != 0) || unlockzero) {
				value = MiscRatioStart * remaining_amount;
				SetSliderValue('divide_misc', value);
			}
			
			UpdateAmounts();
			if (correct_error_now)
				CorrectRoundingError();
			UpdateAmounts();
		}
	}
	
	function UpdateMiscSlider() {
		if (Sliding_Index == 5) {
			var remaining_amount = $('#divide_misc').slider("option", "max") - GetSliderValue("divide_misc");
			
			//Update other sliders
			var value = 0;
			var unlockzero = (GetNumberSlidersZero() >= 5);
			if (($('#divide_axiom').slider("value") != 0) || unlockzero) {
				value = remaining_amount * AxiomRatioStart;
				SetSliderValue('divide_axiom', value);
			}
			if (($('#divide_opencine').slider("value") != 0) || unlockzero) {
				value = remaining_amount * OpenCineRatioStart;
				SetSliderValue('divide_opencine', value);
			}
			if (($('#divide_dictator').slider("value") != 0) || unlockzero) {
				value = DictatorRatioStart * remaining_amount;
				SetSliderValue('divide_dictator', value);
			}
			if (($('#divide_website').slider("value") != 0) || unlockzero) {
				value = WebsiteRatioStart * remaining_amount;
				SetSliderValue('divide_website', value);
			}
			if (($('#divide_hollywood').slider("value") != 0) || unlockzero) {
				value = HollywoodRatioStart * remaining_amount;
				SetSliderValue('divide_hollywood', value);
			}
			
			UpdateAmounts();
			if (correct_error_now)
				CorrectRoundingError();
			UpdateAmounts();
		}
	}
	
	function CalcStartingSliderValues(slidingindex) {
		if (GetNumberSlidersZero() >= 5) {
			AxiomRatioStart 	= 1/GetNumberSlidersZero();
			OpenCineRatioStart 	= 1/GetNumberSlidersZero();
			WebsiteRatioStart 	= 1/GetNumberSlidersZero();
			DictatorRatioStart 	= 1/GetNumberSlidersZero();
			HollywoodRatioStart = 1/GetNumberSlidersZero();
			MiscRatioStart 		= 1/GetNumberSlidersZero();
		} else {
			var sum = 0;
			if (slidingindex == 0) {
				sum = ((GetSliderValue("divide_opencine")/100000) + 
					   (GetSliderValue("divide_website")/100000) + (GetSliderValue("divide_dictator")/100000) + 
					   (GetSliderValue("divide_hollywood")/100000) + (GetSliderValue("divide_misc")/100000));
			} else if (slidingindex == 1) {
				sum = ((GetSliderValue("divide_axiom")/100000) + 
					   (GetSliderValue("divide_website")/100000) + (GetSliderValue("divide_dictator")/100000) + 
					   (GetSliderValue("divide_hollywood")/100000) + (GetSliderValue("divide_misc")/100000));
			} else if (slidingindex == 2) {
				sum = ((GetSliderValue("divide_axiom")/100000) + (GetSliderValue("divide_opencine")/100000) + 
					   (GetSliderValue("divide_website")/100000) + 
					   (GetSliderValue("divide_hollywood")/100000) + (GetSliderValue("divide_misc")/100000));
			} else if (slidingindex == 3) {
				sum = ((GetSliderValue("divide_axiom")/100000) + (GetSliderValue("divide_opencine")/100000) + 
					   (GetSliderValue("divide_dictator")/100000) +
					   (GetSliderValue("divide_hollywood")/100000) + (GetSliderValue("divide_misc")/100000));
			} else if (slidingindex == 4) {
				sum = ((GetSliderValue("divide_axiom")/100000) + (GetSliderValue("divide_opencine")/100000) + 
					   (GetSliderValue("divide_website")/100000) + (GetSliderValue("divide_dictator")/100000) + 
					   (GetSliderValue("divide_misc")/100000));
			} else if (slidingindex == 5) {
				sum = ((GetSliderValue("divide_axiom")/100000) + (GetSliderValue("divide_opencine")/100000) + 
					   (GetSliderValue("divide_website")/100000) + (GetSliderValue("divide_dictator")/100000) + 
					   (GetSliderValue("divide_hollywood")/100000));
			}
			AxiomRatioStart 	= (GetSliderValue("divide_axiom")+1)/100000 / sum;
			OpenCineRatioStart 	= (GetSliderValue("divide_opencine")+1)/100000 / sum;
			WebsiteRatioStart 	= (GetSliderValue("divide_website")+1)/100000 / sum;
			DictatorRatioStart 	= (GetSliderValue("divide_dictator")+1)/100000 / sum;
			HollywoodRatioStart = (GetSliderValue("divide_hollywood")+1)/100000 / sum;
			MiscRatioStart 		= (GetSliderValue("divide_misc")+1)/100000 / sum;
		}
	}
	
	$(function() {
		$("#divide_axiom").slider({
			orientation: "horizontal",
			range: "min",
			max: 100000,
			value: 39000,
			step: 1,
			slide: UpdateAxiomSlider,
			start: function(e, ui) {
				Sliding_Index = 0
				CalcStartingSliderValues(Sliding_Index);
			},
			stop: function(e, ui) {
				correct_error_now = true;
			}, 
			change: UpdateAxiomSlider
		});
		
		$("#divide_opencine").slider({
			orientation: "horizontal",
			range: "min",
			max: 100000,
			value: 22000,
			step: 1,
			slide: UpdateOpenCineSlider,
			start: function(e, ui) {
				Sliding_Index = 1
				CalcStartingSliderValues(Sliding_Index);
			},
			stop: function(e, ui) {
				correct_error_now = true;
			}, 
			change: UpdateOpenCineSlider
		});
		
		$("#divide_dictator").slider({
			orientation: "horizontal",
			range: "min",
			max: 100000,
			value: 22000,
			step: 1,
			slide: UpdateDictatorSlider,
			start: function(e, ui) {
				Sliding_Index = 2;
				CalcStartingSliderValues(Sliding_Index);
			},
			stop: function(e, ui) {
				correct_error_now = true;
			}, 
			change: UpdateDictatorSlider
		});
		
		$("#divide_website").slider({
			orientation: "horizontal",
			range: "min",
			max: 100000,
			value: 5000,
			step: 1,
			slide: UpdateWebsiteSlider,
			start: function(e, ui) {
				Sliding_Index = 3
				CalcStartingSliderValues(Sliding_Index);
			},
			stop: function(e, ui) {
				correct_error_now = true;
			}, 
			change: UpdateWebsiteSlider
		});
		
		$("#divide_hollywood").slider({
			orientation: "horizontal",
			range: "min",
			max: 100000,
			value: 12000,
			step: 1,
			slide: UpdateHollywoodSlider,
			start: function(e, ui) {
				Sliding_Index = 4;
				CalcStartingSliderValues(Sliding_Index);
			},
			stop: function(e, ui) {
				correct_error_now = true;
			}, 
			change: UpdateHollywoodSlider
		});
		
		$("#divide_misc").slider({
			orientation: "horizontal",
			range: "min",
			max: 100000,
			value: 12000,
			step: 1,
			slide: UpdateMiscSlider,
			start: function(e, ui) {
				Sliding_Index = 5;
				CalcStartingSliderValues(Sliding_Index);
			},
			stop: function(e, ui) {
				correct_error_now = true;
			}, 
			change: UpdateMiscSlider
		});
	});
	
	function isValidEmailAddress(emailAddress) {
		var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
		return pattern.test(emailAddress);
	};

	function ValidateInput() {
		// Validate Email Address
		if(!isValidEmailAddress($('#email').val())) { 
			$('#EmailErrorHolder').fadeIn('fast').css("display","inline-block");
			$('#ErrorHolder').fadeIn('fast').css("display","inline-block");
			return false;
		} else {
			$('#EmailErrorHolder').fadeOut('fast');
			$('#ErrorHolder').fadeOut('fast');
		}
		
		// Subscribe people to NL if they wish to
		if ($('#newsletter').prop("checked"))
			SubscribeNL();

		var data = {
			Email: $('#email').val(),
			Donation_Type: $("input:radio[name='donation_freq']:checked").val(),
			Donation_Amount: total_donation
		}

		/*$.post('PATH_TO_log_donation.php'', data, function(returnedData) {
			//$("#paypal_form").submit(true);
		});*/
		
		// Track Goal
		try {
			var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 18);
			piwikTracker.trackGoal(1) ;
		} catch( err ) {}
		
		pausecomp(500); // nasty hack to allow the post data to be processed before leaving the page
		return true;
	}
	
	function pausecomp(millis) {
		var date = new Date();
		var curDate = null;
		do { curDate = new Date(); }
		while(curDate-date < millis);
	}
	
	function SubscribeNL() {
		var data = {
			email: $('#email').val()
		}
		$.post('http://groups.google.com/group/apertus/boxsubscribe', data, function(returnedData) {
		});
	}
	
	</script>