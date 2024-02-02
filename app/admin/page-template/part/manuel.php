<h2>Données disponibles</h2>
<table class="widefat striped">
                <thead>
                    <tr>
                        <th>Marqueurs</th>
                        <th>Fonction correspondante</th>
                        <!-- Add more column headers as needed -->
                    </tr>
                </thead>
                <tbody>
                    <?php $bien = new bien(); ?>
                    <?php $methods = $bien->getAvailableMethods(); ?>
                    <?php
                    foreach ($methods as $method):?>
                        <tr>
                            <td>{<?php echo Ng1ImmoFormat::getVariableNameFromMethod($method); ?>}</td>
                            <td><?php echo $method;?>()</td>
                        </tr>
                  <?php endforeach; ?>
       
                    <!-- Add more rows of data as needed -->
                </tbody>
            </table>