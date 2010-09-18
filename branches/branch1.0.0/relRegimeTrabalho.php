<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Relatório de Regimes de Trabalho</title>
        <meta name="keywords" content="regime de trabalho, relatório" />
        <meta name="description" content="Esta é página de relatórios dos regimes de trabalho do sistema de gestão de docentes" />
        <link href="css/default.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div id="wrapper">
            <?php include 'include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                        <h1>Relatório de Regimes de Trabalho</h1>
                        <!-- Fetch Rows -->
                        <table class="aatable">
                            <tr>
                                <th>ID</th>
                                <th>Descrição</th>
                                <th>Qtde. Horas</th>
                                <th>Dedicação Exclusiva</th>
                            </tr>

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
                            $result = $proxy->get_all_regime_trabalho();

                            for($index=0; $index < count($result); $index++) {
                                $depData = $result[$index];
                                echo "<tr>";

                                echo "<td>".$depData['id_regime_trabalho']."</td>";
                                echo "<td>".$depData['descricao']."</td>";
                                echo "<td>".$depData['quantidade_horas']."</td>";
                                if ($depData['dedicacao_exclusiva']) {
                                    echo "<td>Sim</td>";
                                } else {
                                    echo "<td>Não</td>";
                                }
                                echo "</tr>";
                            }

                            ?>

                        </table>
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
