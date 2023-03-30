<?php
use app\components\EventsHelper;
?>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-graduation-cap"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">นักศึกษา</span>
                    <span class="info-box-number">
                        <?=EventsHelper::CountPersonType(1)?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-tag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">บุคลากร</span>
                    <span class="info-box-number"><?=EventsHelper::CountPersonType(2)?></span>
                </div>
            </div>
        </div>
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-walking"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">ภายนอก</span>
                    <span class="info-box-number"><?=EventsHelper::CountPersonType(3)?></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-shield"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">เจ้าหน้าที่ทหาร/ตำรวจ/หน่วยงานความมั่นคง</span>
                    <span class="info-box-number"><?=EventsHelper::CountPersonType(4)?></span>
                </div>
            </div>
        </div>
    </div>