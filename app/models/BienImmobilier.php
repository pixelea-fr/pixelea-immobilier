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



}
