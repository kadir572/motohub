<?php

class Motorcycles {
  private static $motorcycles = array(
    array(
      'make' => 'Yamaha',
      'model' => 'Yzf-r3',
      'imageUrl' => 'https://www.moto-data.net/media/yamaha/pics/yamaha-yzf-r3-2023[1].jpg',
    ),
    array(
      'make' => 'Honda',
      'model' => 'Cbr650r',
      'imageUrl' => 'https://www.de.honda.ch/content/dam/central/motorcycles/supersports/cbr650r_2023/360-view/Matte_Gunpowder_black_metallic/angle001-0x3.5x10.png/jcr:content/renditions/fb_r.png'
    ),
    array(
      'make' => 'Aprilia',
      'model' => 'Rs660',
      'imageUrl' => 'https://www.moto-data.net/media/aprilia/pics/aprilia-rs-660-2021[1].jpg'
    )
  );

  public static function getMotorcycles() {
    return self::$motorcycles;
  }

}