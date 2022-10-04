<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category_type}}`.
 */
class m220418_134516_create_category_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category_type}}', [
            'id' => $this->primaryKey(),
            'type_name' => $this->string()->notNull()->comment('ประเภท'),
            'title' => $this->string()->notNull()->comment('ชื่อ')
        ]);
        $this->insert('category_type',['type_name' => 'person_type','title' => 'ประเภทบุคคล']);
        $this->insert('category_type',['type_name' => 'event_type','title' => 'เหตุการณ์']);
        $this->insert('category_type',['type_name' => 'upload_type','title' => 'ประเภทการอัพโหลด']);
        $this->insert('category_type',['type_name' => 'event_location','title' => 'สถานที่เกิดเหตุ']);
        $this->insert('category_type',['type_name' => 'event_result','title' => 'ผลการปฎิบัตรงาน']);

        $this->insert('category',['category_type' => 5,'name' => 'พบเหตการณ์','title' => 'พบเหตการณ์']);
        $this->insert('category',['category_type' => 5,'name' => 'ไม่พบเหตการณ์','title' => 'ไม่พบเหตการณ์']);

        $this->insert('category',['category_type' => 4,'name' => 'คุ้มสีฐาน','title' => 'คุ้มสีฐาน']);
        $this->insert('category',['category_type' => 4,'name' => 'หอศิลปวัฒนธรรม','title' => 'หอศิลปวัฒนธรรม']);
        $this->insert('category',['category_type' => 4,'name' => 'ศูนย์ประชุมอเนกประสงค์กาญจนาภิเษก','title' => 'ศูนย์ประชุมอเนกประสงค์กาญจนาภิเษก']);
        $this->insert('category',['category_type' => 4,'name' => 'คณะนิติศาสตร์','title' => 'คณะนิติศาสตร์']);
        $this->insert('category',['category_type' => 4,'name' => 'โรงเรียนสาธิตศึกษา (ศึกษาศาสตร์)','title' => 'โรงเรียนสาธิตศึกษา (ศึกษาศาสตร์)']);
        $this->insert('category',['category_type' => 4,'name' => 'สถานีไฟฟ้าย่อย มข','title' => 'สถานีไฟฟ้าย่อย มข']);
        $this->insert('category',['category_type' => 4,'name' => 'สถานีไฟฟ้าย่อย มข.','title' => 'สถานีไฟฟ้าย่อย มข.']);
        $this->insert('category',['category_type' => 4,'name' => 'อาคารจตุรมุข','title' => 'อาคารจตุรมุข']);
        $this->insert('category',['category_type' => 4,'name' => 'อาคารสิริคุณากร','title' => 'อาคารสิริคุณากร']);
        $this->insert('category',['category_type' => 4,'name' => 'สำนักงานอธิการบดี อาคาร 1','title' => 'สำนักงานอธิการบดี อาคาร 1']);
        $this->insert('category',['category_type' => 4,'name' => 'สำนักงานอธิการบดี อาคาร 2','title' => 'สำนักงานอธิการบดี อาคาร 2']);
        $this->insert('category',['category_type' => 4,'name' => 'อาคารพลศึกษา','title' => 'อาคารพลศึกษา']);
        $this->insert('category',['category_type' => 4,'name' => 'โรงยิมเทเบิลเทนนิส','title' => 'โรงยิมเทเบิลเทนนิส']);
        $this->insert('category',['category_type' => 4,'name' => 'สนามยิงปืน','title' => 'สนามยิงปืน']);
        $this->insert('category',['category_type' => 4,'name' => 'โรงยิมฟันดาบ','title' => 'โรงยิมฟันดาบ']);
        $this->insert('category',['category_type' => 4,'name' => 'อาคารแก่นกัลปพฤกษ์','title' => 'อาคารแก่นกัลปพฤกษ์']);
        $this->insert('category',['category_type' => 4,'name' => 'อาคารพละศึกษา','title' => 'อาคารพละศึกษา']);
        $this->insert('category',['category_type' => 4,'name' => 'สำนักงาน รปภ.','title' => 'สำนักงาน รปภ.']);
        $this->insert('category',['category_type' => 4,'name' => 'ศูนย์อาหารและบริการ 2 (โรงชาย)','title' => 'ศูนย์อาหารและบริการ 2 (โรงชาย)']);
        $this->insert('category',['category_type' => 4,'name' => 'กองกิจการนักศึกษา','title' => 'กองกิจการนักศึกษา']);
        $this->insert('category',['category_type' => 4,'name' => 'องค์การนักศึกษา','title' => 'องค์การนักศึกษา']);
        $this->insert('category',['category_type' => 4,'name' => 'ศูนย์อาหารและบริการ 2','title' => 'ศูนย์อาหารและบริการ 2']);
        $this->insert('category',['category_type' => 4,'name' => 'สมาคมศิษย์เก่า','title' => 'สมาคมศิษย์เก่า']);
        $this->insert('category',['category_type' => 4,'name' => 'อาคารขวัญมอ','title' => 'อาคารขวัญมอ']);
        $this->insert('category',['category_type' => 4,'name' => 'คณะสัตวแพทยศาสตร์','title' => 'คณะสัตวแพทยศาสตร์']);
        $this->insert('category',['category_type' => 4,'name' => 'โรงเรียนสาธิต','title' => 'โรงเรียนสาธิต']);
        $this->insert('category',['category_type' => 4,'name' => 'คณะเกษตรศาสตร์ ','title' => 'คณะเกษตรศาสตร์ ']);
        $this->insert('category',['category_type' => 4,'name' => 'คณะเทคโนโลยี ','title' => 'คณะเทคโนโลยี ']);
        $this->insert('category',['category_type' => 4,'name' => 'สำนักวิทยบริการ','title' => 'สำนักวิทยบริการ']);
        $this->insert('category',['category_type' => 4,'name' => 'คณะวิทยาศาสตร์ ','title' => 'คณะวิทยาศาสตร์ ']);
        $this->insert('category',['category_type' => 4,'name' => 'คณะมนุษยศาสตร์ ฯ','title' => 'คณะมนุษยศาสตร์ ฯ']);
        $this->insert('category',['category_type' => 4,'name' => 'อาคารพิมล กลกิจ ','title' => 'อาคารพิมล กลกิจ ']);
        $this->insert('category',['category_type' => 4,'name' => 'ศาลา พระราชทานปริญญาบัตร (เดิม)','title' => 'ศาลา พระราชทานปริญญาบัตร (เดิม)']);
        $this->insert('category',['category_type' => 4,'name' => 'ศูนย์คอมพิวเตอร์ ','title' => 'ศูนย์คอมพิวเตอร์ ']);
        $this->insert('category',['category_type' => 4,'name' => 'คณะวิทยาการจัดการ','title' => 'คณะวิทยาการจัดการ']);
        $this->insert('category',['category_type' => 4,'name' => 'คณะศึกษาศาสตร์','title' => 'คณะศึกษาศาสตร์']);
        $this->insert('category',['category_type' => 4,'name' => 'คณะวิศวกรรมศาสตร์','title' => 'คณะวิศวกรรมศาสตร์']);
        $this->insert('category',['category_type' => 4,'name' => 'คณะสถาปัตยกรรมศาสตร์','title' => 'คณะสถาปัตยกรรมศาสตร์']);
        $this->insert('category',['category_type' => 4,'name' => 'บ้านชีวาศิลป์มอดินแดง','title' => 'บ้านชีวาศิลป์มอดินแดง']);
        $this->insert('category',['category_type' => 4,'name' => 'สถาบันฯ ลุ่มน้ำโขง','title' => 'สถาบันฯ ลุ่มน้ำโขง']);
        $this->insert('category',['category_type' => 4,'name' => 'สถาบันขงจื้อ','title' => 'สถาบันขงจื้อ']);
        $this->insert('category',['category_type' => 4,'name' => 'วิทยาลัยปกครองท้องถิ่น','title' => 'วิทยาลัยปกครองท้องถิ่น']);
        $this->insert('category',['category_type' => 4,'name' => 'อาคารพจน์ สารสิน','title' => 'อาคารพจน์ สารสิน']);
        $this->insert('category',['category_type' => 4,'name' => 'อาคาร 25 ปี ','title' => 'อาคาร 25 ปี ']);
        $this->insert('category',['category_type' => 4,'name' => 'คณะเภสัชศาสตร์','title' => 'คณะเภสัชศาสตร์']);
        $this->insert('category',['category_type' => 4,'name' => 'คณะพยาบาลศาสตร์','title' => 'คณะพยาบาลศาสตร์']);
        $this->insert('category',['category_type' => 4,'name' => 'คณะสาธารณะสุขศาสตร์ ','title' => 'คณะสาธารณะสุขศาสตร์ ']);
        $this->insert('category',['category_type' => 4,'name' => 'คณะเทคนิคการแพทย์','title' => 'คณะเทคนิคการแพทย์']);
        $this->insert('category',['category_type' => 4,'name' => 'อาคารเรียนรวมและห้องปฏิบัติการวิจัยคณะแพทย์ฯ','title' => 'อาคารเรียนรวมและห้องปฏิบัติการวิจัยคณะแพทย์ฯ']);
        $this->insert('category',['category_type' => 4,'name' => 'คณะแพทยศาสตร์','title' => 'คณะแพทยศาสตร์']);
        $this->insert('category',['category_type' => 4,'name' => 'โรงพยาบาลศรีนครินทร์','title' => 'โรงพยาบาลศรีนครินทร์']);
        $this->insert('category',['category_type' => 4,'name' => 'คณะทันตแพทยศาสตร์','title' => 'คณะทันตแพทยศาสตร์']);
        $this->insert('category',['category_type' => 4,'name' => 'ศูนย์หัวใจสิริกิติ์ฯ','title' => 'ศูนย์หัวใจสิริกิติ์ฯ']);
        $this->insert('category',['category_type' => 4,'name' => 'คณะศิลปะกรรมศาสตร์ ','title' => 'คณะศิลปะกรรมศาสตร์ ']);
        $this->insert('category',['category_type' => 4,'name' => 'ศูนย์อาหารหนองแวง ','title' => 'ศูนย์อาหารหนองแวง ']);
        $this->insert('category',['category_type' => 4,'name' => 'สถาบันวิจัยและพัฒนา','title' => 'สถาบันวิจัยและพัฒนา']);
        $this->insert('category',['category_type' => 4,'name' => 'วิทยาลัยบัณฑิตศึกษาการจัดการ','title' => 'วิทยาลัยบัณฑิตศึกษาการจัดการ']);
        $this->insert('category',['category_type' => 4,'name' => 'หอพักนพรัตน์ (หอพัก9หลัง)','title' => 'หอพักนพรัตน์ (หอพัก9หลัง)']);
        $this->insert('category',['category_type' => 4,'name' => 'หอพักสวัสดิการ (หอพัก 8 หลัง)','title' => 'หอพักสวัสดิการ (หอพัก 8 หลัง)']);
        $this->insert('category',['category_type' => 4,'name' => 'ปั๊มน้ำมัน ปตท','title' => 'ปั๊มน้ำมัน ปตท']);
        $this->insert('category',['category_type' => 4,'name' => 'U Plaza','title' => 'U Plaza']);
        $this->insert('category',['category_type' => 4,'name' => 'หอพักนักศึกษา','title' => 'หอพักนักศึกษา']);
        $this->insert('category',['category_type' => 4,'name' => 'เขตบ้านพัก (มอดินแดง)','title' => 'เขตบ้านพัก (มอดินแดง)']);
        $this->insert('category',['category_type' => 4,'name' => 'ศาลเจ้าพ่อมอดินแดง','title' => 'ศาลเจ้าพ่อมอดินแดง']);
        $this->insert('category',['category_type' => 4,'name' => 'เขตฟาร์ม','title' => 'เขตฟาร์ม']);
        $this->insert('category',['category_type' => 4,'name' => 'สนามกีฬากลาง','title' => 'สนามกีฬากลาง']);
        $this->insert('category',['category_type' => 4,'name' => 'สวนร่มเกล้ากาลพฤกษ์','title' => 'สวนร่มเกล้ากาลพฤกษ์']);
        $this->insert('category',['category_type' => 4,'name' => 'เขตบ้านพัก (ศูนย์แพทย์1)','title' => 'เขตบ้านพัก (ศูนย์แพทย์1)']);
        $this->insert('category',['category_type' => 4,'name' => 'หอพักนักศึกษาคณะพยาบาลศาสตร์ 1 ','title' => 'หอพักนักศึกษาคณะพยาบาลศาสตร์ 1 ']);
        $this->insert('category',['category_type' => 4,'name' => 'บริเวณอุทยานเทคโนโลยีการเกษตร','title' => 'บริเวณอุทยานเทคโนโลยีการเกษตร']);
        $this->insert('category',['category_type' => 4,'name' => 'หอพักนักศึกษาคณะพยาบาลศาสตร์ 2 ','title' => 'หอพักนักศึกษาคณะพยาบาลศาสตร์ 2 ']);
        $this->insert('category',['category_type' => 4,'name' => 'เขตบ้านพัก(ศูนย์แพทย์ 2) ','title' => 'เขตบ้านพัก(ศูนย์แพทย์ 2) ']);
        $this->insert('category',['category_type' => 4,'name' => 'เขตบ้านพัก (หนองแวง)','title' => 'เขตบ้านพัก (หนองแวง)']);
        $this->insert('category',['category_type' => 4,'name' => 'สวนป่า','title' => 'สวนป่า']);
        $this->insert('category',['category_type' => 4,'name' => 'สนามกีฬาสีฐาน','title' => 'สนามกีฬาสีฐาน']);
        $this->insert('category',['category_type' => 4,'name' => 'เขตบ้านพัก (สีฐาน) ','title' => 'เขตบ้านพัก (สีฐาน) ']);
        $this->insert('category',['category_type' => 4,'name' => 'บึงสีฐาน ','title' => 'บึงสีฐาน ']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category_type}}');
    }
}
