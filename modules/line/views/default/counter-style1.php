
<?php
use app\components\EventsHelper;
?>
<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info" data-aos="fade-up" data-aos-delay="400">
              <div class="inner">
                <h3><?=EventsHelper::CountPersonType(1)?></h3>

                <p>นักศึกษา</p>
              </div>
              <div class="icon">
              <i class="fas fa-graduation-cap"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success" data-aos="fade-up" data-aos-delay="500">
              <div class="inner">
              <h3><?=EventsHelper::CountPersonType(2)?></h3>

                <p>บุคลากร</p>
              </div>
              <div class="icon">
              <i class="fas fa-user-tag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning" data-aos="fade-up" data-aos-delay="600">
              <div class="inner">
              <h3><?=EventsHelper::CountPersonType(3)?></h3>

                <p>ภายนอก</p>
              </div>
              <div class="icon">
              <i class="fas fa-walking"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger" data-aos="fade-up" data-aos-delay="700">
              <div class="inner">
              <h3><?=EventsHelper::CountPersonType(4)?></h3>

                <p>เจ้าหน้าที่ทหาร/ตำรวจ/หน่วยงานความมั่นคง</p>
              </div>
              <div class="icon">
              <i class="fas fa-user-shield"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

