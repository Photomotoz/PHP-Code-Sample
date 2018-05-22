<?php
namespace PHP_CODE_SAMPLE;

class FormProcessing
{
    function processPost()
    {
        if (isset($_POST['submit'])) {

            $uniqueDomains = [];

            foreach (preg_split('/[\s]+/', $_POST["email_field"]) as $email) {

                trim($email);

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $uniqueDomains[explode('@', $email)[1]] = null;
                }
            }

            if (count($uniqueDomains) == 0) {
                echo 'No valid domains were found';
            } else {
                echo count($uniqueDomains).' unique domains were found';
                foreach (array_keys($uniqueDomains) as $index=>$domain) {
                    echo '<br>' . ($index+1) . '. ' . $domain;
                }
            }
        }
        else {
            $this->printForm();
        }
    }

    function printForm()
    {

        echo '  <form action="" method="post">
    <textarea name="email_field" rows="5" cols="40" placeholder="Enter emails here" autofocus></textarea>
    <p><input type="submit" name="submit"/></p></form>';
    }
}

$processor = new FormProcessing();
$processor->processPost();
?>