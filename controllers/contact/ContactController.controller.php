<?php



class ContactController extends Controller {



    public static function view($request, $vars, $context = array()){



        if(isset($_SESSION['additionalContext'])){

            $context = array_merge($context, $_SESSION['additionalContext']);

            unset($_SESSION['additionalContext']);

        }

        if(isset($_SESSION['mailError'])){
            $context['errors'] = array($_SESSION['mailError']);
            unset($_SESSION['mailError']);
        }

        $context['captcha'] = Utils::getCaptcha();

        $_SESSION['phrase'] = $context['captcha']['phrase'];

        self::renderTemplate('contact' . ds . 'contact.tpl',$context);



    }



    public static function refreshCaptcha($request, $vars){

        if($request->isAjax()){

            $captcha = Utils::getCaptcha();

            $_SESSION['phrase'] = $captcha['phrase'];

            echo json_encode($captcha);

        } else {

            ApplicationController::pageNotFound($request, $vars);

        }

    }



    public static function add($request, $vars) {



        $formData = ContactForm::getValues();



        if ($formData['success']) {


            $contact = new ContactModel();

            $contact->name->value = $formData['data']['name'];

            $contact->email->value = $formData['data']['email'];

            $contact->phone->value = $formData['data']['phone'];

            $contact->topic->value = $formData['data']['topic'];

            $contact->content->value = $formData['data']['content'];

            $contact->date->value = date('Y-m-d');

            $contact->answered->value = 0;

            $contact->save();



            /**

             *  Mail send section

             */

            $mails = Array(

                Application::$settings['mail']['to'],

            );

            $cc = array(

            );

            $message = "Ad, soyad: " . $contact->name->value . "\n\rEmail: " . $contact->email->value . "\n\rNömrə: " . $contact->phone->value . "\n\rMövzu: " . $contact->topic->value . "\n\rMəzmun: " . $contact->content->value . "\n\rTarix: " . date("Y-m-d H:i:s");

            $from = Application::$settings['lpw']['from'];

            $fromName = Application::$settings['lpw']['fromName'];

            $subject = 'Elektron müraciət';

            try{
                Utils::sendMail($mails, $subject, $message, $from, $fromName, $cc);
                $context['added'] = 'success';
            } catch(Exception $e) {

                //file_put_contents("log.txt", $e->getMessage() . "\n", FILE_APPEND);

                //$_SESSION['mailError'] = "Hal hazırda sorğunuz gəbul olunmadı, lütfən bir az sonra təkrarlayın.";
                file_put_contents("log.txt", $e->getMessage() . "\n" . $e->getTraceAsString(), FILE_APPEND);
                header("Location: " . Application::$settings['url'] . "/" . Application::$storage['lang'] . "/contact");
            }

        } else {

            $context['errors'] = $formData['errors'];

        }

        $_SESSION['additionalContext'] = $context;

        header("Location: " . Application::$settings['url'] . "/" . Application::$storage['lang'] . "/contact");

    }

}