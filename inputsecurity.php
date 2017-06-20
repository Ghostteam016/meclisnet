<?php
class veritemizle{

                public $veri;

                public $temizveri;

                public $temizle;

 

                function temizle($veri){

                        $this->veri=$veri;
                         $this->temizle=array("<" => "", '"' => '', '>' => '', "'" => "", "-" => "");

          $this->temizveri =strtr($this->veri,$this->temizle);

         return true;

                }

}
?>