<?php 
class Ng1AdminListBien {
    public function __construct() {
        // Ajouter la colonne de miniature au listing des biens
       add_filter('manage_bien_posts_columns', array($this, 'addThumbnailColumn'));
        
        // Afficher la miniature dans la colonne ajoutée
       add_action('manage_bien_posts_custom_column', array($this, 'displayThumbnailColumn'), 10, 2);
        
     //  // Rendre la colonne triable
       add_filter('manage_edit-bien_sortable_columns', array($this, 'makeThumbnailColumnSortable'));
       
       // Trier par miniature lorsqu'il est demandé
       add_action('pre_get_posts', array($this, 'sortThumbnailColumn'));
    }

    // Ajouter la colonne de miniature au listing des biens
    public function addThumbnailColumn($columns) {
        $columns['thumbnail'] = 'Miniature';
        return $columns;
    }

    // Afficher la miniature dans la colonne ajoutée
    public function displayThumbnailColumn($column, $post_id) {
       
        if ($column === 'thumbnail') {
         
            $thumbnail_id = get_post_thumbnail_id($post_id);
            $thumbnail = wp_get_attachment_image($thumbnail_id,'thumbnail');
         if (!empty($thumbnail)) {
                echo $thumbnail;
            }else{
               echo '-';
            }
        }

    }

    // Rendre la colonne triable
    public function makeThumbnailColumnSortable($sortable_columns) {
        $sortable_columns['thumbnail'] = 'thumbnail';
        return $sortable_columns;
    }

    // Trier par miniature lorsqu'il est demandé
    public function sortThumbnailColumn($query) {
        if (!is_admin() || !$query->is_main_query()) {
            return;
        }

        $orderby = $query->get('orderby');

        if ($orderby === 'thumbnail') {
            $query->set('meta_key', '_thumbnail_id');
            $query->set('orderby', 'meta_value_num');
        }
    }
}

// Instancier la classe pour que les actions soient ajoutées
new Ng1AdminListBien();

