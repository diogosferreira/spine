    <?php
            if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message'])){
                $corpo = "De: " . $_POST['name'] . "<" . $_POST['email'] . ">\n\n"
. $_POST['message'];
                send_email("zyrtaeb-adrecal@hotmail.com", $_POST['subject'], $corpo);
            }
            
            function send_email($para, $assunto, $corpo){
                if (mail($para , $assunto , $corpo)) {
                    echo("<script >alert('Mensagem pronta para envio!');
history.back() </script>"); 
                } else {
                    echo("<script >alert('Falha no envio!'); history.back() </script>");
                }
            }
        ?>