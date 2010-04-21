<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Relatório de Portarias por Professor</title>
        <meta name="keywords" content="portaria por professor, relatório" />
        <meta name="description" content="Esta é página de relatórios de portarias por professor do sistema de gestão de docentes" />
        <link href="css/default.css" rel="stylesheet" type="text/css" />
    </head>


    <body>
        <div id="wrapper">
        <?php include 'include/header.php'; ?>

            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                        <h1>Relatório de Portarias por Professor</h1>

                        <!--body-->
                        <?php
                        require_once("lib/nusoap.php");
                        require_once("classes/configuration.php");

                        $config = new Configuration();
                        $wsdl = $config->get_wsdl();
                        $client = new soapclientnusoap($wsdl, true);
                        $err = $client->getError();
                        if ($err) {
                            echo '<h2>Erro na construcao do cliente nuSoap: </h2><pre>' . $err . '</pre>';
                        }
                        $proxy = $client->getProxy();

                        //Se foi clicado no botão "Visualizar"
                        if (isset($_POST['submit'])) {
                            $id_professor = $_POST['Id_professor'];

                            $result2 = $proxy->get_professor( $id_professor );
                            $depData2 = $result2[0];
                            echo "Professor: ".$depData2['matricula']." - ".$depData2['nome']." ".$depData2['sobrenome'];

                            echo '<table class="aatable">';
                                echo '<tr>';
                                    echo '<th>ID</th>';
                                    echo '<th>Portaria</th>';
                                    echo '<th>Descrição</th>';
                                echo '</tr>';

                                $result = $proxy->get_all_portaria_por_professor($id_professor);

                                for($index=0; $index < count($result); $index++) {
                                    $depData = $result[$index];
                                    echo "<tr>";

                                    echo "<td>".$depData['id_portaria']."</td>";
                                    echo "<td>".$depData['portaria']."</td>";
                                    echo "<td>".$depData['descricao']."</td>";
                                    echo "</tr>";
                                }
                                echo '</table>';

                        } else {
                            echo '<form method="post">';
                            echo '<p>';
                            echo '<div id="LProfessor">Professor</div>';
                            echo '<select name ="Id_professor">';

                            $result = $proxy->get_all_professor();

                            for($index=0; $index < count($result); $index++) {
                                $depData = $result[$index];
                                echo "<OPTION VALUE=".$depData['id_professor'].">".$depData['nome']." ".$depData['sobrenome'];
                            }
                            echo '</select>';
                            echo '</p>';
                            echo '<p></p>';
                            echo '<p>';
                            echo '<input class="form_submitb" name="submit" type="submit" value="Visualizar" >';
                            echo '<input class="form_submitb" name="reset" type="reset" value="Cancelar" >';
                            echo '</p>';
                            echo '</form>';
                        }
                        ?>

                        <!--body ends-->
                    </div>
                    <div id="note">
                        <p>Emitido em: <?php echo date('d/m/Y H:i:s P') ?></p>
                    </div>
                    <!-- end div#welcome -->

                </div>
                <!-- end div#content -->
                <div id="sidebar">
                    <ul>
                        <?php include 'include/navRelatorio.php'; ?>
                        <!-- end navigation -->
                    </ul>
                </div>
                <!-- end div#sidebar -->
                <div style="clear: both; height: 1px"></div>
            </div>
            <?php include 'include/footer.php'; ?>
        </div>
        <!-- end div#wrapper -->
    </body>
</html>

