<?php
// Classe de l'interface du bien immobilier
// Methode obligatoires dans les classes qui implementent cette interface
interface BienImmobilier {
    public function getData();
    //public function insererBien();
}

// Classe de base pour les biens immobiliers
abstract class BienImmobilierBase implements BienImmobilier {
    protected $post_id;
    protected $ident;
    protected $ref;
    protected $type_transaction;
    protected $type_bien;
    protected $description;
    protected $cp;
    protected $ville;
    protected $pays;
    protected $adresse;
    protected $quartier;
    protected $activites_commerciales;
    protected $prix;
    protected $loyer_murs;
    protected $loyer_cc;
    protected $loyer_ht;
    protected $honoraires;
    protected $surface;
    protected $surface_terrain;
    protected $nb_pieces;
    protected $nb_chambres;
    protected $date_dispo;
    protected $charges;
    protected $etage;
    protected $nb_etage;
    protected $meuble;
    protected $annee_construction;
    protected $refait_a_neuf;
    protected $nb_sdb;
    protected $nb_salle_eau;
    protected $nb_wc;
    protected $wc_separe;
    protected $type_chauffage;
    protected $type_cuisine;
    protected $orientation_sud;
    protected $orientation_est;
    protected $orientation_ouest;
    protected $orientation_nord;
    protected $nb_balcons;
    protected $surface_balcons;
    protected $ascenceur;
    protected $cave;
    protected $nb_parkings;
    protected $nb_boxes;
    protected $digicode;
    protected $interphone;
    protected $gardien;
    protected $terrasse;
    protected $prix_semaine_basse_saison;
    protected $prix_quinzaine_basse_saison;
    protected $prix_mois_basse_saison;
    protected $prix_semaine_haute_saison;
    protected $prix_quinzaine_haute_saison;
    protected $prix_mois_haute_saison;
    protected $nb_personnes;
    protected $type_residence;
    protected $situation;
    protected $nb_couverts;
    protected $nb_lits_doubles;
    protected $nb_lits_simple;
    protected $alarme;
    protected $cable_tv;
    protected $calme;
    protected $climatisation;
    protected $piscine;
    protected $amenagement_handicapes;
    protected $animaux_acceptes;
    protected $cheminee;
    protected $congelateur;
    protected $four;
    protected $lave_vaisselle;
    protected $micro_ondes;
    protected $placards;
    protected $telephone;
    protected $proche_lac;
    protected $proche_tennis;
    protected $proche_pistes_ski;
    protected $vue_degagee;
    protected $chiffre_affaire;
    protected $longueur_facade;
    protected $duplex;
    protected $publications;
    protected $mandat_exclusif;
    protected $coup_de_coeur;
    protected $titre_photo_1;
    protected $titre_photo_2;
    protected $titre_photo_3;
    protected $titre_photo_4;
    protected $titre_photo_5;
    protected $titre_photo_6;
    protected $titre_photo_7;
    protected $titre_photo_8;
    protected $titre_photo_9;
    protected $url_visite_virtuelle;
    protected $tel_a_afficher;
    protected $contact_a_afficher;
    protected $email_a_afficher;
    protected $cp_reel;
    protected $ville_reelle;
    protected $intercabinet;
    protected $intercabinet_prive;
    protected $num_mandat;
    protected $date_mandat;
    protected $nom_mandataire;
    protected $prenom_mandataire;
    protected $rs_mandataire;
    protected $adresse_mandataire;
    protected $cp_mandataire;
    protected $ville_mandataire;
    protected $tel_mandataire;
    protected $commentaires_mandataire;
    protected $commentaires_prives;
    protected $code_negociateur;
    protected $code_langue_1;
    protected $proximite_langue_1;
    protected $libelle_langue_1;
    protected $descriptif_langue_1;
    protected $code_langue_2;
    protected $proximite_langue_2;
    protected $libelle_langue_2;
    protected $descriptif_langue_2;
    protected $code_langue_3;
    protected $proximite_langue_3;
    protected $libelle_langue_3;
    protected $descriptif_langue_3;
    protected $etat_interieur;
    protected $surface_jardin;
    protected $taxe_fonciere;
    protected $nb_parkint;
    protected $nb_parkext;
    protected $nb_garage;
    protected $type_transport;
    protected $terrain_gaz;
    protected $peripherique;
    protected $depot_garantie;
    protected $recent;
    protected $travaux_a_prevoir;
    protected $identifiant_technique;
    protected $conso_energie;
    protected $lettre_conso_energie;
    protected $emission_ges;
    protected $lettre_emission_ges;
    protected $identifiant_quartier;
    protected $sous_type_de_bien;
    protected $periodes_dispo;
    protected $periodes_basse_saison;
    protected $periodes_haute_saison;
    protected $prix_bouquet;
    protected $rente_mensuelle;
    protected $age_homme;
    protected $age_femme;
    protected $entree;
    protected $residence;
    protected $parquet;
    protected $vis_a_vis;
    protected $transport_ligne;
    protected $transport_station;
    protected $duree_bail;
    protected $places_en_salle;
    protected $monte_charge;
    protected $quai;
    protected $nb_bureaux;
    protected $prix_droit_entree;
    protected $prix_masque;
    protected $loyer_annuel;
    protected $charges_annuelles;
    protected $loyer_annuel_m2;
    protected $charges_annuelles_m2;
    protected $charges_mensuelles_ht;
    protected $loyer_annuel_cc;
    protected $loyer_annuel_ht;
    protected $charges_annuelles_ht;
    protected $loyer_annuel_m2_cc;
    protected $loyer_annuel_m2_ht;
    protected $charges_annuelles_m2_ht;
    protected $divisible;
    protected $surf_divisible_min;
    protected $surf_divisible_max;
    protected $surf_sejour;
    protected $nb_vehicules;
    protected $prix_droit_bail;
    protected $valeur_achat;
    protected $repartition_ca;
    protected $terrain_agricole;
    protected $equipement_bebe;
    protected $terrain_constructible;
    protected $resultat_actuel;
    protected $immeuble_de_parkings;
    protected $parking_isole;
    protected $si_viager_vendu_libre;
    protected $logement_a_dispo;
    protected $terrain_en_pente;
    protected $plan_eau;
    protected $lave_linge;
    protected $seche_linge;
    protected $connexion_internet;
    protected $conditions_financieres;
    protected $presta_diverses;
    protected $montant_du_rapport;
    protected $nature_bail;
    protected $nature_bail_commercial;
    protected $nbr_terrasses;
    protected $prix_ht;
    protected $si_salle_a_manger;
    protected $si_sejour;
    protected $terrain_donne_sur_rue;
    protected $immeuble_de_type_bureaux;
    protected $terrain_viabilise;
    protected $equipement_video;
    protected $surf_cave;
    protected $surf_salle_a_manger;
    protected $situation_habituelle;
    protected $data_255;
    protected $data_256;
    protected $data_257;
    protected $data_258;
    protected $nb_lot;
    protected $mt_charges_annuelles;
    protected $t_lock;
    protected $images;
    protected $thumbnail;
    protected $slides;


    public function __construct($post_id=null) {
        $this->post_id = $post_id;
        // Si un $post_id est fourni, charger les métadonnées du post
        if (!is_null($post_id)) {
            $this->loadPostMetadata();
            $this->loadPostImagesMetadata();
        }
    }


    /**
     * Une méthode magique qui permet d'appeler des méthodes inaccessibles.
     *
     * @param string $name Le nom de la méthode appelée.
     * @param array $arguments Un tableau d'arguments passés à la méthode.
     * @throws \Exception Si la propriété n'existe pas dans la classe Bien.
     * @return mixed La valeur de la propriété si c'est une méthode getter, ou void si c'est une méthode setter.
     */
    public function __call($name, $arguments) {
        $prefix = substr($name, 0, 3);
        $property =  Ng1ImmoFormat::formatToUnderscore(lcfirst(substr($name, 3)));
            if ($prefix === 'get' && property_exists($this, $property)) {

                //si la propriété est un tableau avec une seule ligne, elle retournera le premier élément du tableau, sinon elle retournera la valeur de la propriété elle-même.
                $value = is_array($this->$property) && count($this->$property) === 1
                ? $this->$property[0]
                : $this->$property;
                // Appliquer le filtre à la valeur
                $filter_name = 'ng1_filter_' . trim($property);
                $value = apply_filters($filter_name, $value);
      

                return $value;
            } elseif ($prefix === 'set' && property_exists($this, $property)) {
                $this->$property = $arguments[0];
            }
    }
    /**
     * Définit les variables de l'objet à partir d'un tableau associatif.
     *
     * @param array $data Un tableau associatif contenant les noms des variables en tant que clés et leurs valeurs.
     */
    public function setVariablesFromArray($data) {
        $out=array();
        foreach ($data as $key => $value) {
       
            // Si la valeur est un tableau avec une seule ligne, utilisez la première valeur comme une chaîne
            $value = (is_array($value) && count($value) === 1) ? $value[0] : $value;
            $formattedKey = Ng1ImmoFormat::formatToCamelCase($key);
        
            // Modifiez cette ligne pour refléter le nom de la propriété dans votre classe
            $property =Ng1ImmoFormat::formatToUnderscore($key); 
            $method = 'set' . $formattedKey; 
            // Appliquez le filtre sur la valeur de la propriété
            $filter_name ='ng1_filter_'.trim($property);
            $value = apply_filters($filter_name, $value, $data);

            if (method_exists($this, $method)) {
                $this->$method($value);
            } elseif (method_exists($this, '__call')) {
                $out[$method] =$value;
                // Utilisez le nom de la propriété dans la méthode magique __call
                $this->__call($method, [$value]);
            }
            
        }
        //var_dump($out);
    }





    /**
     * Récupère et formate les données pour utilisation dans la vue.
     *
     * @return array Les données formatées.
     */
    public function getFormattedData() {
        $data=array();
        $data['description']= $this->getDescription();
        $data['prix']= Ng1ImmoFormat::formatPrice($this->getPrix());
      
        return $data;
    }
    /**
     * Récupère les données de l'objet courant.
     *
     * @return array
     */
    public function getData() {
        return get_object_vars($this);
    }
    /**
     * Charge les métadonnées du post WordPress associé.
     */
    private function loadPostMetadata() {
        // Vérifier si le post existe
        $post = get_post($this->post_id);

        if ($post instanceof WP_Post) {
            // Charger les métadonnées du post
            $metadata = get_post_meta($this->post_id, '', true);
            // Mettre à jour les propriétés de la classe avec les valeurs des métadonnées
            foreach ($metadata as $key => $value) {
                
                $formattedKey = Ng1ImmoFormat::getPropertyNameFromMetadata($key);
                $property = Ng1ImmoFormat::formatToUnderscore($key);
                $method = 'set' . $formattedKey;
    
                // Appliquer le filtre sur la valeur de la propriété
                $filter_name = 'ng1_filter_' . trim($property);
                $value = apply_filters($filter_name, $value, $metadata);

                // Vérifier si la méthode existe avant de l'appeler
                if (method_exists($this, $method)) {
                    $this->$method($value);
                } elseif (method_exists($this, '__call')) {
                    // Utiliser la méthode magique __call si la méthode spécifique n'existe pas
                    $this->__call($method, [$value]);
                }
            }
        }
    }

    private function loadPostImagesMetadata() {
        // Vérifier si le post existe
        $post = get_post($this->post_id);

        if ($post instanceof WP_Post) {
            // Charger les métadonnées du post
            $metadata = get_post_meta($this->post_id, '', true);
            $metadataFiltered = array_filter($metadata, function($key) {
                return strpos($key, 'photo') !== false;
            }, ARRAY_FILTER_USE_KEY);
            
            $images =array();
            // Mettre à jour les propriétés de la classe avec les valeurs des métadonnées
            foreach ($metadataFiltered as $key => $value) {
                if (is_array($value) && isset($value[0]) && $value[0] !== '') {
                    $images[] = $value[0];
                }
            }
            
            $img = implode(',', $images);
            $this->setImages($img);
            $this->setSlides($img);
            if(!empty($images) && !empty($images[0])){
                $this->setThumbnail($images[0]);
            }
          
        }
    }
    /**
     * Récupère les méthodes disponibles pour l'instance actuelle de la classe.
     *
     * @return array Un tableau de méthodes disponibles.
     */
    public  function getAvailableMethods() {
        $out =array();
        $methods = get_class_methods($this);
        $getters = array_filter($methods, function($method) {
            return strpos($method, 'get') === 0;
        });
        foreach ($getters as $getter) {
            $out[] = $getter ;
        }
        $class = get_class($this);
        $properties = get_class_vars($class);
        $propertyValues = array();
        foreach ($properties as $property => $value) {
            $out[] ='get'.Ng1ImmoFormat::formatToCamelCase( $property);
        }
        return $out;
    }
    public function getVariables(){
        return get_object_vars($this);
    }
    public function getTypeDeBien(){
        $post_id = $this->getPostId();
        
        // Vérifier si l'identifiant de l'article est valide
        if (!is_numeric($post_id) || $post_id <= 0) {
            return 'L\'identifiant de l\'article n\'est pas valide.';
        }
    
        // Récupérer les termes de la taxonomie pour cet article
        $terms = get_the_terms($post_id, 'type_de_bien');
    
        // Vérifier s'il y a des termes
        if (empty($terms)) {
            return "";
        }
    
        // Initialiser une chaîne pour stocker les noms de termes
        $taxonomy_string = '';
    
        // Parcourir tous les termes et les ajouter à la chaîne
        foreach ($terms as $term) {
            $taxonomy_string .= $term->name . ', ';
        }
    
        // Retirer la virgule et l'espace en trop à la fin de la chaîne
        $taxonomy_string = rtrim($taxonomy_string, ', ');
    
        return $taxonomy_string;
    }
    
    public function getNbPieces(){
        if(! isset($this->nb_pieces[0])){
            return "";
        }
        if($this->nb_pieces[0] == 1){
            return $this->nb_pieces[0]." pièce";
        }
       
       return  $this->nb_pieces[0]." pièces";
    }
    public function getSurface($with_style = true){
        if(! isset($this->surface[0])){
            return "";
        }
        if(! empty($with_style)){
            $picto= '<svg version="1.1" height="1.2em" width="1.2em" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
       <style type="text/css">
           .surface0{fill:#788082;}
           .surface1{fill:#824676;}
       </style>
       <path id="Tracé_23" class="surface0" d="M41.4,8C21.7,8,5.7,23.9,5.7,43.6c0,0,0,0,0,0.1v107c0.5,19.7,16.9,35.2,36.6,34.7
           c19-0.5,34.2-15.8,34.7-34.7V79.3h71.3c19.7,0.5,36.1-15,36.6-34.7c0.5-19.7-15-36.1-34.7-36.6c-0.6,0-1.3,0-1.9,0L41.4,8z"/>
       <path id="Tracé_24" class="surface0" d="M77,364.6c-0.5-19.7-16.9-35.2-36.6-34.7c-19,0.5-34.2,15.8-34.7,34.7v107
           c0,19.7,15.9,35.6,35.6,35.7c0,0,0.1,0,0.1,0h107c19.7-0.5,35.2-16.9,34.7-36.6c-0.5-19-15.8-34.2-34.7-34.7H77V364.6z"/>
       <path id="Tracé_25" class="surface1" d="M362.3,8c-19.7-0.5-36.1,15-36.6,34.7c-0.5,19.7,15,36.1,34.7,36.6c0.6,0,1.3,0,1.9,0h71.3v71.3
           c0.5,19.7,16.9,35.2,36.6,34.7c19-0.5,34.2-15.8,34.7-34.7v-107C505,24,489.1,8,469.4,8c0,0-0.1,0-0.1,0L362.3,8z"/>
       <path id="Tracé_26" class="surface0" d="M505,364.6c-0.5-19.7-16.9-35.2-36.6-34.7c-19,0.5-34.2,15.8-34.7,34.7V436h-71.3
           c-19.7,0.5-35.2,16.9-34.7,36.6c0.5,19,15.8,34.2,34.7,34.7h107c19.7,0,35.6-15.9,35.7-35.6c0,0,0,0,0,0V364.6z"/>
       </svg>';
            return  $picto.$this->surface[0]." m²";
        }else{
            return  $this->surface[0];
        }
    }
    public function getSurfaceTerrain($with_style = true){
        if(! isset($this->surface_terrain[0]) || $this->surface_terrain[0] == 0 ){
            return "";
        }
        if(! empty($with_style)){
            $picto ='<svg version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 505 461.8" height="1.2em" style="enable-background:new 0 0 505 461.8;" xml:space="preserve">
       <style type="text/css">
           .surface0{fill:#824676;}
           .surface1{fill:#788082;}
       </style>
       <path id="Tracé_116" class="surface0" d="M232.8,116.3c0.1-22.4-8.5-43.9-23.9-60.1c-4-34.8-35.5-59.8-70.3-55.8
           c-29.3,3.4-52.4,26.5-55.8,55.8c-15.4,16.2-24,37.7-24,60.1c0,0.8,0,1.6,0.2,2.4c-47.4,47.9-46.9,125.2,1,172.5
           c19,18.8,43.7,30.8,70.2,34.2v96.9c0,8.6,7,15.6,15.6,15.6c8.6,0,15.6-7,15.6-15.6v-96.9C228.3,317,275.6,255.8,267,189
           c-3.4-26.6-15.5-51.4-34.4-70.5C232.8,117.8,232.8,117.1,232.8,116.3"/>
       <path id="Tracé_117" class="surface0" d="M454.8,193v-0.2c0-17.2-6.4-33.7-17.9-46.5c-3.9-28.3-30-48-58.2-44.1
           c-22.9,3.2-40.9,21.2-44.1,44.1c-11.5,12.7-17.9,29.3-17.9,46.5v0.2c-17.1,17.7-26.6,41.3-26.5,65.9c0.1,46.7,33.8,86.5,79.8,94.2
           v69.4c0,8.6,7,15.6,15.6,15.6c8.6,0,15.6-7,15.6-15.6V353c46.2-7.6,80-47.5,80-94.2C481.4,234.3,471.9,210.6,454.8,193"/>
       <path class="surface1" d="M481.2,461.8H23.8C10.6,461.8,0,451.2,0,438.1c0-13.1,10.6-23.8,23.8-23.8h457.5c13.1,0,23.8,10.6,23.8,23.8
           C505,451.2,494.4,461.8,481.2,461.8z"/>
       </svg>';
            $picto2='<svg version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 512 512" height="1.2em" width="1.2em" style="enable-background:new 0 0 512 512;" xml:space="preserve">
       <style type="text/css">
           .surface0{fill:#824676;}
           .surface1{fill:#788082;}
       </style>
       <path id="Tracé_116" class="surface0" d="M234.8,136.8c0.1-22.4-8.5-43.9-23.9-60.1c-4-34.8-35.5-59.8-70.3-55.8
           c-29.3,3.4-52.4,26.5-55.8,55.8c-15.4,16.2-24,37.7-24,60.1c0,0.8,0,1.6,0.2,2.4c-47.4,47.9-46.9,125.2,1,172.5
           c19,18.8,43.7,30.8,70.2,34.2v96.9c0,8.6,7,15.6,15.6,15.6c8.6,0,15.6-7,15.6-15.6V346c66.8-8.6,114.1-69.7,105.5-136.5
           c-3.4-26.6-15.5-51.4-34.4-70.5C234.8,138.3,234.8,137.6,234.8,136.8"/>
       <path id="Tracé_117" class="surface0" d="M456.8,213.5v-0.2c0-17.2-6.4-33.7-17.9-46.5c-3.9-28.3-30-48-58.2-44.1
           c-22.9,3.2-40.9,21.2-44.1,44.1c-11.5,12.7-17.9,29.3-17.9,46.5v0.2c-17.1,17.7-26.6,41.3-26.5,65.9c0.1,46.7,33.8,86.5,79.8,94.2
           v69.4c0,8.6,7,15.6,15.6,15.6c8.6,0,15.6-7,15.6-15.6v-69.4c46.2-7.6,80-47.5,80-94.2C483.4,254.8,473.9,231.1,456.8,213.5"/>
       <path class="surface1" d="M483.2,482.3H25.8C12.6,482.3,2,471.7,2,458.6s10.6-23.8,23.8-23.8h457.5c13.1,0,23.8,10.6,23.8,23.8
           S496.4,482.3,483.2,482.3z"/>
       </svg>
       ';
            return  $picto."<span title='Surface du terrain' class='ng1-immo__surface-terrain'>".$this->surface_terrain[0]." m² </span>";
        }else{
            return  $this->surface_terrain[0];
        }
    }
    public function getNbChambres($with_style = true){
        if(! isset($this->nb_chambres[0]) || $this->nb_chambres[0] == 0 ){
            return "";
        }
        if(! empty($with_style)){
            $picto='<svg version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 496 387.5" height="1.2em" style="enable-background:new 0 0 496 387.5;" xml:space="preserve">
       <style type="text/css">
           .room0{fill:#787F81;}
           .room1{fill:#824676;}
       </style>
       <path id="Tracé_96" class="room0" d="M0,275.9v111.6h75v-58.4h346v58.3h75V275.8L0,275.9z"/>
       <path id="Tracé_97" class="room0" d="M86.5,118.5c1.1-28,10.1-57.8,79.2-61.1c22.4-2.9,45.1,2,64.2,13.9c9.2,6.8,15.5,17,17.4,28.3
           h1.3c1.9-11.3,8.1-21.5,17.4-28.3c19.2-11.9,41.9-16.8,64.2-13.9c69.1,3.2,78.1,33.1,79.2,61.1l6,1.9c12.3,4,24.3,9.2,35.7,15.3
           V35.7C451,16,435.1,0.1,415.5,0h-335C60.9,0,44.9,16,44.9,35.7v100.1c11.4-6.2,23.3-11.3,35.7-15.3L86.5,118.5"/>
       <path id="Tracé_98" class="room1" d="M451.2,161.1c-11.1-7.3-23.1-13.2-35.7-17.7c-11.6-4.2-23.6-7.6-35.7-10.2
           c-43.4-8.7-87.6-12.7-131.8-11.9c-44.2-0.8-88.4,3.2-131.8,11.9c-12.1,2.6-24,6-35.7,10.2C68,147.9,56,153.8,44.8,161.1
           C16.5,178.9-0.2,210.5,1,243.9h494C496.2,210.5,479.5,178.9,451.2,161.1"/>
       </svg>';
            $picto2='<svg version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 512 512" height="1.2em" width="1.2em" style="enable-background:new 0 0 512 512;" xml:space="preserve">
       <style type="text/css">
           .room0{fill:#787F81;}
       .room1{fill:#824676;}
       </style>
       <path id="Tracé_96" class="room0" d="M8,346.4V458h75v-58.4h346v58.3h75V346.3L8,346.4z"/>
       <path id="Tracé_97" class="room0" d="M94.5,189c1.1-28,10.1-57.8,79.2-61.1c22.4-2.9,45.1,2,64.2,13.9c9.2,6.8,15.5,17,17.4,28.3h1.3
           c1.9-11.3,8.1-21.5,17.4-28.3c19.2-11.9,41.9-16.8,64.2-13.9c69.1,3.2,78.1,33.1,79.2,61.1l6,1.9c12.3,4,24.3,9.2,35.7,15.3V106.1
           c0-19.6-15.9-35.6-35.5-35.7h-335c-19.7,0-35.6,16-35.6,35.7v100.1c11.4-6.2,23.3-11.3,35.7-15.3L94.5,189"/>
       <path id="Tracé_98" class="room1" d="M459.2,231.6c-11.1-7.3-23.1-13.2-35.7-17.7c-11.6-4.2-23.6-7.6-35.7-10.2
           C344.4,195,300.2,191,256,191.8c-44.2-0.8-88.4,3.2-131.8,11.9c-12.1,2.6-24,6-35.7,10.2C76,218.4,64,224.3,52.8,231.6
           C24.5,249.4,7.8,280.9,9,314.4h494C504.2,280.9,487.5,249.4,459.2,231.6"/>
       </svg>';
            return  $picto."<span title='Nombre de chambres' class='ng1-immo__nb-chambres'>".$this->nb_chambres[0]." Chambres </span>";
        }else{
            return  $this->nb_chambres[0];
        }
    }
    /**
     * Récupère les données descriptives du bien.
     *
     * Cette méthode récupère les données descriptives du bien telles que l'année de construction,
     * le nombre de pièces, la surface, etc., et les organise dans un tableau associatif.
     * L'ordre des éléments dans le tableau de sortie peut être spécifié en fournissant un tableau d'ordre personnalisé.
     *
     * @param array|null $order Un tableau optionnel spécifiant l'ordre des éléments dans le tableau de sortie.
     *                          Les valeurs possibles sont : "annee-construction", "nbpiece", "surface", "surface-terrain",
     *                          "surface-sejour", "nb-chambres", "garage", "parking". Par défaut, l'ordre est défini comme suit :
     *                          ["annee-construction", "nbpiece", "surface", "surface-terrain", "surface-sejour",
     *                          "nb-chambres", "garage", "parking"].
     *
     * @return array Un tableau contenant les données descriptives du bien, organisées selon l'ordre spécifié.
     */
    public function getSurfSejour($with_style = true){

        if(! isset($this->surf_sejour[0]) || empty($this->surf_sejour[0])  ){
            return "";
        }
        if(! empty($with_style)){
            $picto='<svg version="1.1" id="Calque_1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 489.9 289.2" height="1.2em" style="enable-background:new 0 0 489.9 289.2;" xml:space="preserve">
       <style type="text/css">
           .canape0{fill:#824676;}
           .canape1{fill:#787F81;}
       </style>
       <path id="Tracé_163" class="canape0" d="M255.3,132.3v34.2h142.2c3.9,0.5,7.5-2.3,8-6.3c0.1-0.5,0.1-1.1,0-1.6v-29.1
           c-22.9-4.7-46.2-6.9-69.6-6.7C308.7,122.4,281.6,125.6,255.3,132.3"/>
       <path id="Tracé_164" class="canape0" d="M153,102.3c31.1-0.4,62,3.5,92,11.7c30-8.2,60.9-12.1,92-11.7c23.3-0.1,46.6,2,69.6,6.3
           c0.1-25.6-0.6-61.7-2.8-82.7c-0.1-14.5-12-26.1-26.5-26c-0.5,0-1,0-1.4,0.1H114.1c-14.4-1-26.9,10-27.9,24.4c0,0.5-0.1,1-0.1,1.5
           c-2.1,21-2.9,57.2-2.8,82.7C106.4,104.4,129.7,102.2,153,102.3"/>
       <path id="Tracé_165" class="canape0" d="M84.3,158.6c-0.4,4,2.5,7.5,6.4,7.9c0.5,0.1,1.1,0,1.6,0h142.3v-34.2
           c-26.4-6.7-53.5-9.9-80.8-9.5c-23.4-0.2-46.7,2.1-69.6,6.7V158.6z"/>
       <path id="Tracé_166" class="canape1" d="M467.6,67.5h-20.2c-11.2-0.7-20.9,7.8-21.6,19c-0.1,1.1-0.1,2.3,0.1,3.4v74.7
           c1.3,11-6.6,20.9-17.6,22.2c-1.5,0.2-3,0.2-4.6,0H86.4c-11,1.2-21-6.7-22.2-17.7c-0.2-1.5-0.2-3,0-4.5V89.9
           c1.2-11.1-6.9-21.1-18.1-22.3c-1.1-0.1-2.3-0.1-3.4-0.1H22.3C10.9,66.7,0.9,75.3,0.1,86.7c-0.1,1-0.1,2,0,3v116.3
           c-1.6,20.8,14,39.1,34.8,40.7c2.1,0.2,4.2,0.2,6.3,0h407.4c20.8,1.9,39.2-13.5,41.1-34.3c0.2-2.1,0.2-4.2,0-6.3V89.7
           c0.8-11.4-7.8-21.4-19.2-22.2C469.6,67.5,468.6,67.5,467.6,67.5"/>
       <path id="Tracé_167" class="canape1" d="M467.6,289.2h-20.2c-11.2,0.7-20.9-7.8-21.6-19c-0.1-1.1-0.1-2.3,0.1-3.4v2.1
           c1.3-11-6.6-20.9-17.6-22.2c-1.5-0.2-3-0.2-4.6,0H86.4c-11-1.3-20.9,6.6-22.2,17.6c-0.2,1.5-0.2,3,0,4.6v-2.2
           c1.2,11.1-6.9,21.1-18.1,22.3c-1.1,0.1-2.3,0.1-3.4,0.1H22.3c-11.4,0.8-21.4-7.8-22.2-19.2c-0.1-1-0.1-2,0-3v-39.4
           c-1.6-20.8,14-39.1,34.8-40.7c2.1-0.2,4.2-0.1,6.3,0h407.4c20.8-1.9,39.2,13.5,41.1,34.3c0.2,2.1,0.2,4.2,0,6.3V267
           c0.8,11.4-7.8,21.4-19.2,22.2C469.6,289.2,468.6,289.2,467.6,289.2"/>
       </svg>';
            return  $picto."<span title='Surface du séjour' class='ng1-immo__surface-sejour'>".$this->surf_sejour[0]." m² </span>";
        }else{
            return  $this->surf_sejour[0];
        }
    }
    public function getDescriptifData($order = null){
        $annee_construction_value = !empty($this->annee_construction[0]) ? $this->annee_construction[0] : '';
        $nb_pieces_value = !empty($this->nb_pieces[0]) ? $this->nb_pieces[0] . " pièces" : '';
        $surface_value = !empty($this->surface[0]) ? $this->surface[0] . " m²" : '';
        $surface_terrain_value = !empty($this->surface_terrain[0]) ? $this->surface_terrain[0] . " m²" : '';
        $surf_sejour_value = !empty($this->surf_sejour[0]) ? $this->surf_sejour[0] . " m²" : '';
        $nb_chambres_value = !empty($this->nb_chambres[0]) ? $this->nb_chambres[0] : '';
        $nb_garage_value = !empty($this->nb_garage[0]) ? $this->nb_garage[0] : '';
        $nb_parkings_value = !empty($this->nb_parkings[0]) ? $this->nb_parkings[0] : '';
        
        // Définir l'ordre des éléments dans le tableau final
        $default_order = array(
            "annee-construction",
            "nbpiece",
            "surface",
            "surface-terrain",
            "surface-sejour",
            "nb-chambres",
            "garage",
            "parking"
        );
    
        // Utiliser l'ordre spécifié ou l'ordre par défaut si aucun n'est fourni
        $selected_order = is_array($order) ? $order : $default_order;

        // Initialiser le tableau final
        $data = array();
    
        // Ajouter les éléments dans l'ordre spécifié
        foreach ($selected_order as $item) {
            switch ($item) {
                case "annee-construction":
                    if (!empty($annee_construction_value)) {
                        $data[] = array("label" => "Année de construction", "value" => $annee_construction_value, "class" => $item);
                    }
                    break;
                case "nbpiece":
                    if (!empty($nb_pieces_value)) {
                        $data[] = array("label" => "Nombre de pièces", "value" => $nb_pieces_value, "class" => $item);
                    }
                    break;
                case "surface":
                    if (!empty($surface_value)) {
                        $data[] = array("label" => "Surface", "value" => $surface_value, "class" => $item);
                    }
                    break;
                case "surface-terrain":
                    if (!empty($surface_terrain_value)) {
                        $data[] = array("label" => "Surface terrain", "value" => $surface_terrain_value, "class" => $item);
                    }
                    break;
                case "surface-sejour":
                    if (!empty($surf_sejour_value)) {
                        $data[] = array("label" => "Surface séjour", "value" => $surf_sejour_value, "class" => $item);
                    }
                    break;
                case "nb-chambres":
                    if (!empty($nb_chambres_value)) {
                        $data[] = array("label" => "Nombre de chambres", "value" => $nb_chambres_value, "class" => $item);
                    }
                    break;
                case "garage":
                    if (!empty($nb_garage_value)) {
                        $data[] = array("label" => "Garage", "value" => $nb_garage_value, "class" => $item);
                    }
                    break;
                case "parking":
                    if (!empty($nb_parkings_value)) {
                        $data[] = array("label" => "Parking", "value" => $nb_parkings_value, "class" => $item);
                    }
                    break;
            }
        }
    
        return $data;
    }

    /**
     * Récupère le contenu de l'objet.
     *
     * Cette méthode récupère le contenu de l'objet, tel que la description, et le retourne.
     * Elle permet également aux autres extensions ou thèmes de modifier le contenu avant qu'il ne soit retourné,
     * en appliquant le filtre 'custom_get_content'.
     *
     * @return string Le contenu de l'objet, éventuellement modifié par des filtres.
     */
    public function getContent(){
        $content = $this->description[0];

        // Appliquer un filtre pour permettre aux autres extensions ou thèmes de modifier le contenu et passer l'objet comme argument
        $content = apply_filters('custom_bien_content', $content, $this);

        return $content;
    }
}
