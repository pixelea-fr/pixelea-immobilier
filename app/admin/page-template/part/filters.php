<h2>Filtres Disponibles</h2>
<table class="widefat striped">
                <thead>
                    <tr>
                        <th>Filtre</th>
                        <th>Description</th>
                        <!-- Add more column headers as needed -->
                    </tr>
                </thead>
                <tbody>
                        <?php
                        $filter = Ng1ImmobilierFilterManager::get_instance();
                        $filter_docs = $filter->get_docs();
                        foreach ($filter_docs as $filter_name => $doc) :
                            $doc =Ng1ImmoFormat::parsePhpDocToArray($doc);
                            ?>
                            <tr>
                                <td><?php echo $filter_name; ?></td>
                                <td><?php echo $doc['description']; ?></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                </tbody>
            </table>
<?php


