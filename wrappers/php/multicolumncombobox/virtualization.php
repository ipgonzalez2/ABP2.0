<?php

require_once '../lib/DataSourceResult.php';
require_once '../lib/Kendo/Autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');

    $request = json_decode(file_get_contents('php://input'));

    $result = new DataSourceResult('sqlite:..//sample.db');

    echo json_encode($result->read('Products', array('ProductID', 'ProductName'), $request));

    exit;
}

require_once '../include/header.php';

$transport = new \Kendo\Data\DataSourceTransport();

$read = new \Kendo\Data\DataSourceTransportRead();

$read->url('http://demos.telerik.com/kendo-ui/service/Northwind.svc/Orders');

$transport->read($read);

$model = new \Kendo\Data\DataSourceSchemaModel();

$shipNameField = new \Kendo\Data\DataSourceSchemaModelField('ShipName');
$shipNameField->type('string');

$shipCityField = new \Kendo\Data\DataSourceSchemaModelField('ShipCity');
$shipCityField->type('string');

$orderIDField = new \Kendo\Data\DataSourceSchemaModelField('OrderID');
$orderIDField->type('number');

$freightField = new \Kendo\Data\DataSourceSchemaModelField('Freight');
$freightField->type('number');

$orderDateField = new \Kendo\Data\DataSourceSchemaModelField('OrderDate');
$orderDateField->type('date');

$model->addField($shipNameField)
      ->addField($freightField)
      ->addField($orderIDField)
      ->addField($shipCityField)
      ->addField($orderDateField);

$schema = new \Kendo\Data\DataSourceSchema();

$schema->model($model);

$dataSource = new \Kendo\Data\DataSource();

$dataSource->type('odata')
           ->transport($transport)
           ->schema($schema)
           ->pageSize(80)
           ->serverFiltering(true)
           ->serverPaging(true);

$virtual = new \Kendo\UI\ComboBoxVirtual();

$virtual->itemHeight(33)
        ->valueMapper('valueMapper');

$multicolumncomboBox = new \Kendo\UI\MultiColumnComboBox('orders');

$multicolumncomboBox->dataSource($dataSource)
         ->dataTextField('ShipName')
         ->dataValueField('OrderID')
         ->addColumn(
            array('field' => 'OrderID', 'title' => 'ID', 'width' => 100),
            array('field' => 'ShipName', 'title' => 'Name', 'width' => 300),
            array('field' => 'ShipCountry', 'title' => 'Country', 'width' => 200)
           )
         ->filter('contains')
         ->virtual($virtual)
         ->height(290)
         ->attr('style', 'width: 100%;');

?>
<div class="demo-section k-content">
    <h4>Orders</h4>
<?php
echo $multicolumncomboBox->render();
?>
</div>
<script>
    function valueMapper(options) {
        $.ajax({
            url: "http://demos.telerik.com/kendo-ui/service/Orders/ValueMapper",
            type: "GET",
            data: convertValues(options.value),
            success: function (data) {
                options.success(data);
            }
        });
    }

    function convertValues(value) {
        var data = {};

        value = $.isArray(value) ? value : [value];

        for (var idx = 0; idx < value.length; idx++) {
            data["values[" + idx + "]"] = value[idx];
        }

        return data;
    }
</script>
<?php require_once '../include/footer.php'; ?>
