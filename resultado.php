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
        

        $maior = 0;
        $arquetipo = '';
        foreach($resultados as $key => $value)
        {
            if($value >= $maior)
            {
                $arquetipo = $key;
                $maior = $value;
            }
        }
        
        return [$arquetipo, $maior];
    }

    function initMailer($email, $nome , $arquetipo)
    {
        try
        {
       
            // Configurações do servidor
            $mail = new PHPMailer();
            $mail->isSMTP();        //Devine o uso de SMTP no envio
            $mail->SMTPAuth = true; //Habilita a autenticação SMTP
            $mail->Username   = 'mixx.viagens@gmail.com';
            $mail->Password   = 'mix$123$456$789';
            // $mail->SMTPDebug = 2;
            // Criptografia do envio SSL também é aceito
            $mail->SMTPSecure = 'tls';
            // Informações específicadas pelo Google
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            // Define o remetente
            $mail->setFrom('ojogodavida.hd@gmail.com', 'O jogo da vida');
            // Define o destinatário
            $mail->addAddress("{$email}", "{$nome}");
            // Conteúdo da mensagem
            $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
            $mail->Subject = 'O jogo da vida';
            $mail->Body = '<div style="font-size: 16px; width: 100%; margin-top:20px; margin-bottom:20px; color: black;">12 Arquetipos</div>';

            $mail->Body .= '<div style="font-size:12px" width: 100%; margin-top:20px; margin-bottom:20px; color: black;> Ola! '. $nome .' muito obrigado por fazer o teste para descobrir seu Arquetipo predominante </div>';



            // $mail->addStringAttachment(file_get_contents('/https://picsum.photos/200/300') , 'image');
            $mail->AddEmbeddedImage('o_'.$arquetipo.'_12_arquetipos.jpg','logoimg');

            $mail->Body .= "<img src=\"cid:logoimg\" />";


            $mail->Body .= '<div style="font-size:12px" width: 100%; margin-top:20px; margin-bottom:20px; color: black;>
            Conheça mais sobre 12 Arquétipos através do nosso Curso de Formação 12 Arquétipos:
            </div>
            
            <div style="font-size:12px" width: 100%; margin-top:20px; margin-bottom:20px;>https://cursos.ojogodavida.com.br/12arquetipos</div>
            <div style="font-size:12px" width: 100%; margin-top:20px; margin-bottom:20px; color: black;>
            Nickson Gabriel
            Diretor Instituto O Jogo da Vida</div>';

        
            if($mail->send()){
                return true;
            }else{
                return false;
            }
        }
        catch (Exception $e)
        {
            echo "Message could not be sent, contate o desenvolvedor . Mailer Error: {$e->getMessage()}";
        }


        
    }

    // $pagina_resultados = file_get_contents('./resultado.shtml');

    $arquetipos = processar_teste($_POST);
  
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
    $terapeuta = filter_var($_POST['terapeut']);

   
    $enviado = initMailer($email, $nome , $arquetipos[0]);

    if($enviado){
        $paginaFinal = file_get_contents('./paginafinal.phtml');
    }else{
        $paginaFinal = file_get_contents('./erro.phtml');

    }

    $db = new JSONDB('database');

    $db->insert('dados.json',
        [
            'nome' => $nome,
            'email' => $email,
            'proximo' => $arquetipos[0],
            'terapeuta' => $terapeuta
        ]
    );



    echo($paginaFinal);
