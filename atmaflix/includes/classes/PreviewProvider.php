<?php
class PreviewProvider {

    private $con, $username;

    public function __construct($con, $username) {
        $this->con = $con;
        $this->username = $username;
    }

    public function createPreviewVideo($entity) {
        
        if($entity == null) {
            $entity = $this->getRandomEntity();
        }

        $id = $entity->getId();
        $name = $entity->getName();
        $preview = $entity->getPreview();
        $thumbnail = $entity->getThumbnail();

 

        return "<div class='previewContainer'>

                    <img src='$thumbnail' class='previewImage' hidden>

                    <video autoplay muted class='previewVideo' onended='previewEnded()'>
                        <source src='$preview' type='video/mp4'>
                    </video>

                    <div class='previewOverlay'>
                        
                        <div class='mainDetails'>
                            <h3>$name</h3>

                            <div class='buttons'>
                                <button><i class='fas fa-play'></i> Play</button>
                                <button onclick='volumeToggle(this)'><i class='fa-solid fa-volume-high'></i></button>
                            </div>

                        </div>

                    </div>

                   
        
                </div>

                
                ";
        
    }

    public function createEntityPreviewSquare($entity) {

        $id = $entity->getId();
        $name = $entity->getName();
        $thumbnail = $entity->getThumbnail();

        return "<a href='entity.php?id=$id'>
                    <div class='previewContainer small'>
                        <img src='$thumbnail' title='$name'>
                    </div>        
                </a>";

    }

    private function getRandomEntity() {

        $entity = EntityProvider::getEntities($this->con, null, 1);
        return $entity[0];
    }

}
?>