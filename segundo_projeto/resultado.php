<?php
    require_once('lib/JSONDB.php');
    require_once('lib/PHPMailer.php');
    require_once('lib/Exception.php');
    require_once('lib/SMTP.php');


    use Jajo\JSONDB;
    // use PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;



    function processar_teste($entry){
        $resultados = array();
       // var_dump($entry);

        $resultados["destruidor"] = $entry[27] + $entry[53] + $entry[56] + $entry[8] + $entry[31] + $entry[72];
        
        $resultados["orfao"] = $entry[21] + $entry[37] + $entry[30] + $entry[58] + $entry[66] + $entry[64];
        
        $resultados["guerreiro"] = $entry[63] + $entry[7] + $entry[45] + $entry[41] + $entry[30] + $entry[9];
        
        $resultados["caridoso"] = $entry[40] + $entry[43] + $entry[4] + $entry[42] + $entry[52] + $entry[5];
        
        $resultados["explorador"] = $entry[1] + $entry[44] + $entry[68] + $entry[35] + $entry[18] + $entry[55];
        
        $resultados["amante"] = $entry[24] + $entry[54] + $entry[3] + $entry[67] + $entry[14] + $entry[13];
        
        $resultados["destruidor"] = $entry[57] + $entry[16] + $entry[38] + $entry[70] + $entry[28] + $entry[62];
        
        $resultados["criador"] = $entry[50] + $entry[51] + $entry[20] + $entry[49] + $entry[61] + $entry[10];
        
        $resultados["mago"] = $entry[65] + $entry[34] + $entry[25] + $entry[69] + $entry[47] + $entry[22];
        
        $resultados["governante"] = $entry[2] + $entry[19] + $entry[33] + $entry[23] + $entry[59] + $entry[32];
        
        $resultados["sabio"] = $entry[17] + $entry[60] + $entry[26] + $entry[15] + $entry[6] + $entry[11];
        
        $resultados["bobo"] = $entry[16] + $entry[48] + $entry[46] + $entry[29] + $entry[71] + $entry[12];
        
       // var_dump($resultados);
        
        arsort($resultados);

        var_dump($resultados);

        $firstkey = array_keys($resultados)[0];
        $lastkey = array_keys($resultados)[count($resultados) - 1];

        return array(urlencode($firstkey), urlencode($lastkey));
    }

    function initMailer($email, $nome)
    {
        try
        {
            // Configurações do servidor
            $mail = new PHPMailer();
            $mail->isSMTP();        //Devine o uso de SMTP no envio
            $mail->SMTPAuth = true; //Habilita a autenticação SMTP
            $mail->Username   = 'mixx.viagens@gmail.com';
            $mail->Password   = 'mix$123$456$789';
            $mail->SMTPDebug = 2;
            // Criptografia do envio SSL também é aceito
            $mail->SMTPSecure = 'tls';
            // Informações específicadas pelo Google
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            // Define o remetente
            $mail->setFrom('netobalby@gmail.com', 'Mix Viagens');
            // Define o destinatário
            $mail->addAddress("{$email}", "{$nome}");
            // Conteúdo da mensagem
            $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
            $mail->Subject = 'Teste';
            $mail->Body    = '<b>12 Arquetipos</b>';
            $mail->AltBody = 'Este é o cortpo da mensagem para clientes de e-mail que não reconhecem HTML';
            // Enviar
            if($mail->send()){
                echo 'A mensagem foi enviada!';
                
            }else{
                echo 'A mensagem nao foi enviada!';

            }
        }
        catch (Exception $e)
        {
            echo "Message could not be sent. Mailer Error: {$e->getMessage()}";
        }


        
    }

    function enviarEmail($email, $nome, $mailer)
    {

    }
    $pagina_resultados = file_get_contents('./resultado.shtml');

    $arquetipos = processar_teste($_POST);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
    initMailer($email, $nome);
    $pagina_resultados = str_replace('%PROXIMO%', $arquetipos[0], $pagina_resultados);
    $pagina_resultados = str_replace('%DISTANTE%', $arquetipos[1], $pagina_resultados);

    $db = new JSONDB('database');

    $db->insert('dados.json',
        [
            'nome' => $nome,
            'email' => $email,
            'proximo' => $arquetipos[0],
            'distante' => $arquetipos[1]
        ]
    );

    initMailer();


    echo($pagina_resultados);
