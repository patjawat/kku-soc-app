<?php
use yii\web\View;
?>

<span class="btn btn-success" id="click">Click</span>
<?php
$js = <<< JS

var socket = io('http://127.0.0.1:3000');

$('#click').click(function (e) { 
    e.preventDefault();
    socket.emit('click', 'Hello click');
});
JS;
$this->registerJs($js,View::POS_END);
?>