<?php

	class CallToController extends Controller {
	
		public static function addOrder($request, $vars) {
			$formData = CallToForm::getValues();
			$success = false;
			if ($formData['success']) {
				$time = $formData['data']['time'];
				$number = $formData['data']['number'];
				$name = $formData['data']['name'];
				$subject = $formData['data']['subject'];
				
				// agclub@agbank.az
				$mails = Array(
					Array('agclub@agbank.az', 'AGClub'),
					Array('vusal@meqa.az', 'Vusal'),
					Array('mammadsa@agbank.az', 'Mammad'),
				);
				$message = '
							<p>Call to:</p>
							<p>Name: '.$name.'</p>
							<p>Subject: '.$subject.'</p>
							<p>Call time: '.$time.'</p>
							<p>Call number: '.$number.'</p>
							';
				$from = Application::$settings['lpw']['from'];
				$fromName = Application::$settings['lpw']['fromName'];
				$subject = 'Call to order';
				Utils::sendMail($mails, $subject, $message, $from, $fromName);

				$order = new CallToModel();
				$order->number->value = $number;
				$order->time->value = $time;
				$order->name->value = $name;
				$order->subject->value = $subject;
				$order->save();
				$success = true;
			}
			$json = Array('success' => $success);
			$json['csrfKey'] = Application::getCSRFKey();
			echo json_encode($json);
		}
	
	}

?>