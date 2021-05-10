<?php
    ob_start();

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

    function arquetipoTexto($arquetipo)
    {  









        // <div class="main-text" style="text-align:left; margin-bottom: 30px;">

        // </div>


        // <div class="main-text" style="text-align:left; margin-bottom: 30px;">

        // </div>

        

        // <div class="main-text" style="text-align:left; margin-bottom: 30px;">

        // </div>


        // <div class="main-text" style="text-align:left; margin-bottom: 30px;">

        // </div>
        

        $arrayTextos = [

            'amante' => '<div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Arquétipo que nos fala diretamente da nossa capacidade de entrega e comprometimento.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Quando o masculino e feminino estão numa dança, o feminino nos ensina a beleza do fluir e a capacidade de ser conduzido pelo fluxo da vida.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Se estamos falando de relações amorosas, o convite é para ir além do controle e o chamado é para o comprometimento com o caminho que se apresenta. Estando no controle jamais iremos chegar ao potencial de transformação que Eros propõe, já que a universidade dos relacionamentos nos exige revelação do nosso mundo interior, das nossas fragilidades e de nossa originalidade. 

            </div>
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O arquétipo toca aquele lugar ferido acumulado de experiências passadas. Aquele momento onde você se abriu para o outro e se feriu, através do abandono e da rejeição. 
            </div>
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O Amante fala da coragem de se arriscar e se abrir novamente com total entrega restaurando essa capacidade de abrir verdadeiramente o coração para o outro. O que se expressa na relação íntima também reflete a relação com a própria vida.
            </div>
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Estar inteiro e comprometido com o caminho.
            </div>
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            No aspecto negativo, traz uma observação a respeito do controle nas relações, da paixão cega, do ciúmes, das obsessões e promiscuidade. 
            </div>
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Se estamos falando de trabalho, nos remete a paixão e comprometimento com aquilo que se faz. Dar o melhor de si e se entregar totalmente para a direção apresentada. 
            </div>
            
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">     
            O propósito de vida somente se realizará com essa entrega total dos talentos, onde realmente damos o nosso melhor.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">     
            A respeito do caminho espiritual, nos fala do enamoramento com o grande mistério, a receptividade para ser conduzido e o compromisso com a senda. 
            </div>
           
            <div class="main-text" style="text-align:left; margin-bottom: 30px;"> 
            Sem entrega e comprometimento total jamais concretizamos nosso potencial de realização em todas as áreas da vida. 
            </div>',



            'bobo' => '<div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Aquele que nos fala da espontaneidade, do despojamento e da criança interior. A confiança maior no fluxo da vida floresce neste arquétipo.
            </div>
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            No primeiro arquétipo dessa série, o Inocente, também  nos falava da confiança , porém, da confiança ainda infantil. Aquela que é proporcionada enquanto ainda estamos dentro do ninho. O Bobo nos remete a uma confiança mais amadurecida, onde podemos confiar em tudo o que a vida nos traz, sem a certeza de uma “rede de segurança”.
            </div>
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            A espontaneidade como elixir para dissolver nossas máscaras e couraças.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            A criança interior que rompe com a seriedade da vida, com toda rigidez e autoexigência exacerbada.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Arquétipo que nos leva além da culpa e nos liga ao sim para a vida e ao prazer de viver. O resgate da alegria e do encantamento.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Nos provoca a descobrirmos o prazer atento à sombra que o mesmo evoca. Autoindulgência, preguiça, gula e irresponsabilidade.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Redescobrir o prazer e alegria de viver é o seu chamado. Mas o caminho é o da desconstrução de tudo que internamente impede a sua natureza original de se expressar livremente nesse mundo, assim como ele é. 
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O que te dá prazer e alegria? Porque não um sim para isso?
            </div>',
        


            'caridoso' => '<div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Aquele que evoca uma das principais virtudes da alma, o espírito do serviço desinteressado.

            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Entretanto, nos provoca em tudo aquilo que impede a verdadeira doação, ou seja, devemos iluminar a “máscara do caridoso” e a avareza.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            A avareza pode nascer do medo, na crença de que se eu der vai faltar. Pode nascer de um sentimento inconsciente de vingança que inicia na infância, algo como “não recebi o queria, então não vou dar o que tenho pra dar” Por isso, tantas vezes queremos nos mover em direção à realização do propósito e da prosperidade, mas não conseguimos avançar. Porque a prosperidade e o propósito só podem ser colocados em movimento quando finalmente damos o que temos para dar. E se existem pactos de vingança, nos deparamos com resistências que, talvez, não conseguimos compreender. Não entendemos por que ficamos paralisados invés de nos mover na direção do que queremos. 
            </div>


            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Outra perspectiva é estudar o arquétipo quando se manifesta como máscara. Falo da máscara do “agradador” como forma de pertencer e de compensar a ferida de desvalor. A pessoa acredita que está doando muito, mas tem dificuldade de receber e sempre chega na frustração e no sentimento de que se sacrificou mais que os demais. 
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Vale ressaltar um regra no grande jogo: 
            Se você não está recebendo, não é verdade que você está doando. Aqui o trabalho é desconstruir o falso caridoso.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            A doação começa para consigo mesmo, depois se extende para o círculo próximo de relacionamentos e posteriormente pode se expandir com consistência. 
            </div>',
            

            'criador' => '<div class="main-text" style="text-align:left; margin-bottom: 30px;">
             Arquétipo que nos fala diretamente da manifestação da nossa essência no mundo
            </div>
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Quando ele surge, indica que já o momento de reconhecer aquilo que é original em nós e a necessidade profunda de manifestar de forma concreta esse algo único que cada um de nós trazemos.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Aqui não cabe replicar ou reproduzir. O chamada é para produzir, ou seja, manifestar, entregar realmente os seus tesouros através dos seus dons e talentos.
            </div>
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            A pergunta que vai bater à porta é a respeito do que se trata, afinal de contas, esse “algo único”. 
            </div> 
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Qual é a sua fragrância, sua essência?
            </div>
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Ainda mais do que isso, ele convoca para a realização e impressão da sua marca no mundo.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Diante dessa provocação, obviamente uma jornada de transformação se amplifica, já que teremos que encarar nossos nãos, a procrastinação e a avareza. Sair do mundo das idéias e tangibilizar. 
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Talvez a ideia de “ser grande”, ou ideal de sucesso herdado pelos seus pais e pela sociedade o distanciem do seu verdadeiro talento, que aparentemente pode ser algo “mais simples”. Mas que vindo da alma, com toda certeza terá um papel e um brilho especial.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O arquétipo nos ajuda a entrar em contato com essa essência e nos encoraja a concretizar.
            </div> 

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Sei bem que podemos fazer muita coisa no mundo, mas quando temos que fazer acontecer aquilo que de fato é o nosso propósito, o falso eu se esperneia para não perder o seu posto. E essa força extra para fazer acontecer pode sim ser ampliada através da clareza e do campo gerado pela conexão com o arquétipo do Criador.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Lembre-se que na essência você já é. Os seus dons já estão com você. É uma transição do não para o sim. O trabalho está em reconhecer e desarmar as resistências, abrir espaço para o original florescer.
            </div>',

        
            

            'destruidor' => '<div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Representante da morte do eu e do fim dos ciclos.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Nesse tempo em que vivemos, quem não está passando pela morte em algum nível?
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Em determinado estágio da jornada do herói, o mesmo enfrentará e passará pela morte para que possa renascer em outro nível.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O fim de um antigo projeto, um relacionamento e principalmente a morte de um “Eu”. 

            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Aspectos da nossa personalidade que em algum momento serviram como uma estratégia inconsciente de proteção a dor, perdem o sentido e nesse estágio já não servem ao seu propósito inicial. Esse “eu” precisa morrer, mas estando identificado com ele, vivemos o medo da aniquilação, que acaba criando mais resistência para esse fim, que na verdade será altamente benéfico.
            </div>


            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Diante do chamado para a “morte”, a melhor estratégia é não ter estratégia e se entregar, se vulnerabilzar, deixar morrer. Não é fácil, pois além de estarmos identificados, não temos a certeza do renascimento que vem depois. O momento é apenas de limpar o terreno, para que algo novo possa brotar.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Estar consciente de que se encontra nesta etapa, pode auxiliar muito, já que também estará consciente de que virá tesouros desta transformação. Esse tipo de morte é inevitável, quanto menos resistência crio, mais rápido e menos doloroso será o processo.
            </div>


            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Imagine que está no meio de um rio com muita correnteza agarrado em uma pedra. Galhos batem em seu rosto, os braços já estão cansados e você segue resistindo. Talvez o chamado seja soltar essa pedra e ir com o rio. Mas sem a certeza do que virá depois, como soltar? A menos que você tenha uma dica no caminho que releve que o rio te deixará em boa margem. 
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O arquétipo está aqui para te lembrar que depois da morte é certo o renascimento, a vida nova.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;"> Desapegue, se entregue e deixe ir! </div>',


            'explorador' => '<div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Aquele que evoca nossa relação com o mistério da vida.

            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Apresenta novos horizontes a serem percorridos e nos traz a necessidade de ativar a chama do buscador em nós.
            </div>
            

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O caminho já conhecido não pode mais resolver nossos grandes dilemas e para isso é preciso esvaziar a xícara.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Sem o espírito de jornada não teremos a disposição para percorrer todo caminho e realizar a transformação necessária. Essa disposição só é ativada através do enamoramento com o grande mistério, com a sincronicidade, com os sinais e reconhecimento da trilha a ser percorrida. Também é preciso ter em mente as recompensas e tesouros do caminho, que apesar dos esforços, apresentam o sentido da missão.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Muitos buscadores em alguma etapa da jornada, se sentem cansados diante de tão longo caminho e inconscientemente, sem que se perceba, já não estão mais renovando o repertório. O caminho muda e apresenta novas bifurcações a cada dia. Para acompanhar esse dinamismo imposto pelo mistério, se faz necessário a capacidade perene de abandonar velhos padrões e velhas formas de caminhar.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O arquétipo sempre nos diz que ainda tem muito a percorrer e precisamos descobrir o prazer no próprio caminhar. Reconhecer que não sabemos de tudo e que sempre temos muito a conhecer e a explorar.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Traz como sombra a zona de conforto, o medo do novo, seja no campo dos relacionamentos, trabalho e também nos fala muito do caminho espiritual, das sendas iniciáticas e do grande propósito da vida.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Digo sempre, que esse é o arquétipo do “Jogador” do Grande Jogo da Vida. Com certeza é esse arquétipo presente em você que te leva a ler um post como esse.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Que essa chama esteja sempre acesa! Que encontre os tesouros presentes no caminho.
            </div>',



            'governante' => '
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Aquele que é senhor de si, nos fala da nossa relação com o poder pessoal, a visão do todo e capacidade de gerir os recursos disponíveis.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Sendo esses os atributos, claramente nos remete ao nosso masculino interno, presente tanto no homem como na mulher.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O masculino distorcido trouxe muitas marcas e feridas que geram uma reação a tudo que contém essa energia. Ou seja, eu nego a distorção mas dentro do pacote nego as potenciais qualidades.
            </div>
            
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Se estou alinhado com a força masculina, posso então me valer dos atributos que o arquétipo traz. Mas como perceber isso de forma clara? Se o arquétipo está ausente, provavelmente você tem dificuldade com a energia masculina. Então as qualidades como poder pessoal, visão, a capacidade de prover e empreender, lidar com autoridades, são qualidades que provavelmente te ajudariam muito nesse momento de sua vida.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Se esse arquétipo tem algo para lhe dizer, mas você já possui essas qualidades, vale então uma atenção maior para aspectos negativos do arquétipo, que representam o masculino distorcido em nós. O controle, a autoexigência, a dureza e a tirania. 
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Esse é o grande trabalho na trilha deixada por este arquétipo, a integração do masculino. O poder distorcido sendo redirecionado para a realização do potencial pessoal.
            </div>
           
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Também nos fala da nossa relação com as autoridades na nossa vida. Afinal, um bom mestre antes de tudo é um bom discípulo. Um bom professor antes de tudo é um bom aluno. 
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Lembrando que o masculino também está na mulher, como você relaciona com a energia masculina? Faltam essas qualidades na sua vida? 
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Disciplina, ordem e poder soam como palavras negativas? Se sim, vale a pena repensar, porque são sim MUITO positivas e fundamentais para que você possa realizar seu propósito nesse mundo.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Se você já possui as qualidades do arquétipo, o chamado maior é para equilibrar a distorção que se manifesta através do controle, autoexigência, tirania e toda forma de dureza diante da vida. E para isso precisará evocar qualidades femininas, como a entrega, a flexibilidade e a empatia.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Se as qualidades desse arquétipo é tudo que precisa para resolver seus problemas, o chamado é para olhar para as marcas profundas que carrega em relação ao masculino até que possa desnudar seu olhar para as qualidades que o masculino traz e reconhecer o verdadeiro valor. 
            </div>
             
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            As pegadas do Arquétipo do Governante nos elevam a capacidade de governarmos livremente nossa vida.
            </div>', 
            
            

    
            'guerreiro' => '<div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Na jornada do herói se valer da imagem arquetípica significa olhar para a sua questão/problema através de uma lente, de um novo ângulo. 
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Neste caso temos aqui o arquétipo ancestral do Guerreiro, aquele que vai em direção ao alvo e cujo tema principal é a coragem.
            </div>
           
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Mas coragem para que?
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O guerreiro é fogo e fogo é energia. Essa energia muitas vezes se encontra estagnada, pois a força da ira está reprimida. O jogador tem dificuldade em lidar com sua agressividade e ao reprimi-la se paralisa diante da vida. A agressividade não catalisada volta-se contra si através da autodestrutividade que pode também se manifestar através de mecanismos de amortecimento como a gula, distração, procrastinação, etc. Acontece que como o jogo da vida é dinâmico, começamos a experimentar situações que procuram ativar essa energia reprimida. Aquele que não lida com sua agressividade começa a vivenciá-la através de outrem, que está representando e provocando exatamente o agressivo reprimido dentro de si mesmo.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Todos temos um guerreiro dentro de nós e podemos transmutar a energia da ira em energia de produtividade, para organizar seus recursos, fazer um plano de ação, destruir os obstáculos que atrapalham o caminho e executar esse plano atingindo o objetivo principal. 
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O maior ato de coragem é reconhecer a própria vulnerabilidade, encarar nossos sentimentos mais desafiadores. Quem é o grande antagonista a ser enfrentado se não, nossas dores mais profundas?
            </div>
             
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Que o guerreiro dentro de você lhe traga a coragem de ser quem você realmente é.
            </div>',

            
            
            
            'inocente' => '<div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O Inocente revela aquela qualidade de confiança presente na criança, que em sua vulnerabilidade se entrega aos cuidados e proteção dos pais.
            </div>
            
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Perceba a entrega do corpo do bebê no colo dos pais. A criança que pega nas mãos dos pais e confiança direção que vier.
            </div>
            
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Mas este ainda é um estágio da confiança que em algum momento será desafiado, pois a criança confia desde que tenha essa rede de proteção.
            </div>
            
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Sendo assim, o arquétipo nos instiga a observar a nossa zona de conforto e negação ao chamado da vida. Paralisia, preguiça e procrastinação.
            </div>
            
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            “Está tão bom aqui, porque eu vou mexer?”
            </div>
            
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Ele busca esse conforto e proteção também através da persona criada com o objetivo de pertencer e ser aceito.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Claro que diante do Grande Jogo da vida essa zona será provocada e aqui o herói trava um grande batalha com a luxúria, o anestesiamento e o prazer do conforto, já que se o mesmo permanecer ali jamais florescerá no seu potencial maior. O chamado da alma há de abalar toda essa estrutura.
            </div>
        
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Pense no seu grande desafio de vida. Como a zona de conforto se manifesta na sua vida? Qual o seu chamado?
            </div>',


            'mago' => '<div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Nos fala do verdadeiro poder pessoal e nossa capacidade de transformar. A alquimia que transforma chumbo em ouro.
            </div>
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            A sombra do arquétipo é o medo que o mesmo carrega de entrar em contato com aquilo que precisa ser transformado e aquilo se voltar contra ele. A exemplo do nosso medo de entrar em contato com nossa raiva e ao fazer isso essa raiva gerar destrutividade. Mas a lembrança do Mago é a do poder de entrar contato com a emoção negada, por exemplo, e só a partir de então poder transformá-la para o seu potencial positivo. Mas é necessário o contato para abrir espaço para o poder de transformação da emoção. 
            </div>
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O Mago tem grande habilidade de captar os conteúdos do inconsciente e trazê-los para o consciente. Por exemplo, ele pega ideias que estavam ocultas na mente inconsciente e as traz para serem executadas na realidade física. Assim como um arquiteto que concebe a idéia de uma casa em sua mente e depois faz a planta da mesma, para que possa ser construída depois.⁣⁣⁣⁣
            </div>
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            É um arquétipo que, apesar de extremamente comunicativo, fala muito sobre o poder da solitude, o entendimento de que sozinhos viemos a esse mundo e sozinhos sairemos dele.⁣⁣⁣⁣
            </div>
    
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O Mago sabe que tudo está conectado. Para ele o sagrado não é algo que está acima ou distante de nós, mas uma força que emerge do nosso próprio ser.⁣⁣⁣⁣
            </div>
    
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Para ele, tudo é possível, pois está em contato com as leis e a harmonia do universo. Como dizia o grande mago Hermes Trismegisto: “O que está embaixo é como o que está no alto, e o que está no alto, é como o que está embaixo”.⁣⁣⁣⁣
            </div>
        
    
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Da mesma forma, o Mago usa as quatro funções da consciência: a sensação (terra), o sentimento (água), o pensamento (ar) e a intuição (fogo), em função de algo maior. Isso lhe permite ser um grande curador de corpos e de almas.⁣⁣⁣⁣
            </div>
    
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O Mago tem poder pessoal, não no sentido de explorar os demais e sim de criar sua própria realidade de forma deliberada, persuadir, transformar o meio e as situações.⁣⁣⁣⁣
            </div>
    
    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Sabe aquela sensação de sincronicidade? Quando tudo na vida parece se conectar? Acontecimentos, pessoas, consciente e inconsciente, sonhos e realidade? Então, essa sincronicidade é um dos maiores trunfos do Mago, pois ele é um ser que transita o tempo todo entre o mundo interior e exterior e entre diferentes dimensões da realidade.⁣⁣⁣⁣
            </div>',



            'orfao' => '<div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O Órfão nos chama para a necessidade de tocar nossa ferida primordial de abandono e fala do desejo inconsciente e negado de pertencer. 
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Fala de algum momento do passado em que precisamos dar conta sozinhos. Isso também traz qualidades, pois neste “se virar sozinhos” também desenvolvemos habilidades fundamentais que nos ajudam a forjar em nós as qualidades necessárias para percorrermos o caminho e assim avançar para o próximo arquétipo que seria “O Guerreiro”. 
            </div>
        
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Acontece que nesse “dar conta sozinho” o arquétipo negativamente um aspecto de autosuficiência e dificuldade de receber ajuda. É aí que se apresenta o maior desafio. Normalmente está relacionado a pessoas que até ajudam bastante outras pessoas mas tem dificuldade de receber ajuda.
            </div>
                    
            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O Órfão nega a sua própria fragilidade e não expor a necessidade real, até para si mesmo, impossibilita que os aliados possam ajudá-lo na jornada. Sem os aliados não podemos percorrer todo o caminho e botar a fragilidade na mesa a ajuda não virá.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Trata-se de uma jornada de entrega e coragem para sentir, se expor e desenvolver a tão necessária interdependência.
            </div>',
            
            
            'sabio' => '<div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Aquele que traz o comprometimento com a busca da verdade, do conhecimento e da sabedoria.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            O primeiro e fundamental ensinamento é o chamado para “esvaziar a xícara”. Se estamos totalmente tomados pelo conhecimento já adquirido não temos espaço para o novo conhecimento chegar. Como dizia um velho sábio, “tudo sei é que nada sei”. O verdadeiro Sábio é um eterno aprendiz.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Nos ensina a respeito da paciência e da sabedoria a respeito do tempo das coisas. Ouve muito e fala pouco. Suas palavras são precisas e no momento certo. Menos movimento e mais assertividade.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Traz como sombra a possibilidade do orgulho e a soberba camuflados. Quando em posse do conhecimento, acreditamos estar acima do outro de alguma forma. Isso gera separação em relação ao outro e ao mundo. A verdadeira sabedoria gera humildade. Aquele que realmente conhece sabe que na essência somos todos iguais e não existe separação.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Seguir a trilha do sábio exige se prostrar diante da própria ignorância, abrindo espaço para a verdadeira sabedoria. A verdade que liberta.
            </div>

            <div class="main-text" style="text-align:left; margin-bottom: 30px;">
            Através do Sábio em nós transformamos a solidão em solitude.
            </div>',
            
        ];

        $arrayVideos = [
            'amante' => 'https://youtu.be/UeyIGGx6Mj8',
            'bobo' => 'https://youtu.be/EjlYHHtmeCg',
            'caridoso' => 'https://youtu.be/aWQ_c6_uzyo',
            'criado' => 'https://youtu.be/RNkXg3R8JQg',
            'destruidor' => 'https://youtu.be/lM9wghiO9SM',
            'explorador' => 'https://youtu.be/7T8zlLGD_jc',
            'governante' => 'https://youtu.be/0zNugRJId-4',
            'guerreiro' => 'https://youtu.be/5N8vWmhj6lw',
            

        ];

        $arrayTitulos = [
            'amante' => 'A Amante',
            'bobo' => 'O Bobo',
            'caridoso' => 'O Caridoso',
            'criador' => 'O Criador',
            'destruidor' => 'O Destruidor',
            'explorador' => 'O Explorador',
            'governante' => 'O Governante',
            'guerreiro' => 'O Guerreiro',
            'inocente' => 'O Inocente',
            'mago'=> 'O Mago',
            'orfao' => 'O Órfão',
            'sabio' => 'O Sábio',
        ];

        $arrayKeys = [ 'inocente' , 'orfao' , 'guerreiro' , 'caridoso' , 'explorador' , 'destruidor' , 'amante' , 'criador' , 'governante', 'mago' , 'sabio', 'bobo'];
        // var_dump($arrayKeys);
        // die;
        return [$arrayTextos[$arquetipo], $arrayVideos[$arquetipo] , $arrayTitulos[$arquetipo] , $arrayKeys];
    }

    function getKeyFromArrayKeys($arquetipo, $arrayKeys)
    {
     
        foreach($arrayKeys as $key => $value)
        {
       
            if($value == $arquetipo){
                
                return $key + 1;

            }
        }

    }

    // $pagina_resultados = file_get_contents('./resultado.shtml');
    try{
     
        $arquetipos = processar_teste($_POST);
  
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
        $terapeuta = filter_var($_POST['terapeut']);
        
        $enviado = true;

        // TODO :  apos resolvido o smtp basta descomentar esta linha e comentar a linha acima
        // $enviado = initMailer($email, $nome , $arquetipos[0]);
        session_start();
        $_SESSION['arquetipos'] = $arquetipos;
        
        if($enviado){
            $paginaFinal = file_get_contents('./paginafinal.phtml');
        }else{
            $paginaFinal = file_get_contents('./erro.phtml');
        }
        $paginaFinal = str_replace('%ARQUETIPO%', $arquetipos[0], $paginaFinal);
        
        list($textoArquetipo, $videoLink , $tituloArquetipo , $arrayKeys) = arquetipoTexto($arquetipos[0]);

        // $version = 'estudante';

        $version = 'online';

    
        $db = new JSONDB('database');
        


        if($version == 'estudante')
        {
            $paginaFinal = file_get_contents('./paginafinal.phtml');
            $paginaFinal = str_replace('%TEXTO%', $textoArquetipo, $paginaFinal);
            $paginaFinal = str_replace('%VIDEOLINK%', $videoLink, $paginaFinal);
            $paginaFinal = str_replace('%TITULOARQUETIPO%', $tituloArquetipo, $paginaFinal);

        }else if($version == 'online'){


            $db->insert('dados.json',
            [
                'nome' => $nome,
                'email' => $email,
                'proximo' => $arquetipos[0],
                'terapeuta' => $terapeuta
            ]
            );



            $key = getKeyFromArrayKeys($arquetipos[0] , $arrayKeys);

            if($key < 10){
                $key = '0'.strval($key);
            }else{
                $key = strval($key);
            }

            // $location = $_SERVER["SERVER_NAME"] . '/' . $key;
            $location =  '/' . $key;

            header("Location:" . $location.'.phtml');
            // $paginaFinal = file_get_contents('./paginaFinalOnline.phtml');

            // echo $paginaFinal;
        }






        
        
        echo($paginaFinal);
    }catch (Exception $e)
    {
        var_dump($e->getMessage());
    }
  
