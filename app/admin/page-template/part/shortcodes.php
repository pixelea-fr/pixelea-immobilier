<h2>Shortcodes disponibles</h2>
<table class="widefat striped">
                <thead>
                    <tr>
                        <th>Shorcodes</th>
                        <th>Paramètres</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                        $shortcodes = Ng1ImmobilierShortcodeManager::get_instance();
                        $shortcodes_docs = $shortcodes->get_docs();
                        foreach ($shortcodes_docs as $shortcodes_name => $doc) :
                            $doc =Ng1ImmoFormat::parsePhpDocToArray($doc);
                            ?>
                            <tr>
                                <td><?php echo $shortcodes_name; ?></td>
                                <td><?php echo $doc['description']; ?></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>


                    <!-- Add more rows of data as needed -->
                </tbody>
            </table>