<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Developed By: Waseem
 */
//ini_set("display_errors", E_ALL);
include('public/config.php');

if (!empty($_POST['filterForm']) && $_POST['filterForm'] == 1) {
    $curl = curl_init(URL . 'product-cart/product/controller/filter.php');
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $_POST);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($resp, true);
} else {
    $curl = curl_init(URL . 'product-cart/product/controller/filter.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($resp, true);
}

$count = 1;
if (!empty($_POST['addForm']) && $_POST['addForm'] == 1) {
    $curl = curl_init(URL . 'product-cart/product/controller/create.php');
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $_POST);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($curl);
    curl_close($curl);
    header("Refresh:0");
}

if (!empty($_POST['id']) && $_POST['id'] > 0) {
    $curl = curl_init(URL . 'product-cart/product/controller/delete.php');
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $_POST);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($curl);
    curl_close($curl);
    header("Refresh:0");
}

include('view/layout.php');
?>
    <body>
        <div class="container">
             <div class="form-group">
            <label for="usr">Search:</label>
            <input type="text" class="form-control" id="brand" name="brand">
            <input type="hidden" name="filterForm" value="2" id="filterForm">
        </div>
            <div class="form-group">
                <label for="usr">Add Product:</label>
            <input type="button" class="btn btn-primary pull-right" onclick="showhide()" value="Create Product"/>
            </div>
        <div class="panel-group">
            <div class="panel panel-primary" id="addDiv" style="display:none">
                <div class="panel-heading">ADD PRODUCT</div>
                <div class="panel-body">
                    <form action="<?php echo URL;?>product/home.php" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="name">Name</label>
                              <input type="text" name="name" class="form-control" id="name">
                              <input type="hidden" name="addForm" value="1">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name">Price</label>
                              <input type="text" name="price" class="form-control" id="price">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name">Discount</label>
                              <input type="text" name="discount" class="form-control" id="discount">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="sel1">Rating:</label>
                                <select class="form-control" name="rating" id="rating">
                                  <option value="">--SELECT--</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sel1">Brand:</label>
                                <select class="form-control" name="brand" id="brand">
                                  <option value="">--SELECT--</option>
                                  <option value="vu">VU</option>
                                  <option value="samsung">samsung</option>
                                  <option value="lg">lg</option>
                                  <option value="apple">apple</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sel1">Color:</label>
                                <select class="form-control" id="color" name="color">
                                  <option value="">--SELECT--</option>
                                  <option value="blue">Blue</option>
                                  <option value="brown">Brown</option>
                                  <option value="black">Black</option>
                                  <option value="green">Green</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary pull-right" value="ADD"/>
                    </form>
                </div>
            </div>
            
            <div class="panel panel-default">
            <div class="panel-heading">FILTER</div>
            <div class="panel-body">
                <form action="<?php echo URL;?>product/home.php" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name">Name</label>
                      <input type="text" name="name" class="form-control" id="name" value="<?php if (!empty($_POST['name'])) echo $_POST['name'];?>">
                      <input type="hidden" name="filterForm" value="1">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">Price</label>
                      <input type="text" name="price" class="form-control" id="price" value="<?php if (!empty($_POST['price'])) echo $_POST['price'];?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="sel1">Rating:</label>
                        <select class="form-control" name="rating" id="rating">
                          <option value="">--SELECT--</option>
                          <option value="1" <?php if (!empty($_POST['rating']) && $_POST['rating'] == 1) {?> SELECTED <?php }?>>1</option>
                          <option value="2" <?php if (!empty($_POST['rating']) && $_POST['rating'] == 2) {?> SELECTED <?php }?>>2</option>
                          <option value="3" <?php if (!empty($_POST['rating']) && $_POST['rating'] == 3) {?> SELECTED <?php }?>>3</option>
                          <option value="4" <?php if (!empty($_POST['rating']) && $_POST['rating'] == 4) {?> SELECTED <?php }?>>4</option>
                          <option value="5" <?php if (!empty($_POST['rating']) && $_POST['rating'] == 5) {?> SELECTED <?php }?>>5</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="sel1">Color:</label>
                        <select class="form-control" id="color" name="color">
                          <option value="">--SELECT--</option>
                          <option value="blue" <?php if (!empty($_POST['color']) && $_POST['color'] == "blue") {?> SELECTED <?php }?>>Blue</option>
                          <option value="brown" <?php if (!empty($_POST['color']) && $_POST['color'] == "brown") {?> SELECTED <?php }?>>Brown</option>
                          <option value="black" <?php if (!empty($_POST['color']) && $_POST['color'] == "black") {?> SELECTED <?php }?>>Black</option>
                          <option value="green" <?php if (!empty($_POST['color']) && $_POST['color'] == "green") {?> SELECTED <?php }?>>Green</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="sel1">Brand:</label>
                        <select class="form-control" name="brand" id="brand">
                          <option value="">--SELECT--</option>
                          <option value="vu" <?php if (!empty($_POST['brand']) && $_POST['brand'] == "vu") {?> SELECTED <?php }?>>VU</option>
                          <option value="samsung" <?php if (!empty($_POST['brand']) && $_POST['brand'] == "samsung") {?> SELECTED <?php }?>>samsung</option>
                          <option value="lg" <?php if (!empty($_POST['brand']) && $_POST['brand'] == "lg") {?> SELECTED <?php }?>>lg</option>
                          <option value="apple" <?php if (!empty($_POST['brand']) && $_POST['brand'] == "apple") {?> SELECTED <?php }?>>apple</option>
                        </select>
                    </div>
                </div>
                <br>
                <input type="submit" class="btn btn-primary pull-right" value="filter"/>
            </form>
            </div>
        </div>
      </div>
            
        <h2>PRODUCT DETAILS</h2>            
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Rating</th>
              <th>Price</th>
              <th>Discount</th>
              <th>Brand</th>
              <th>Color</th>
              <th>Create Date</th>
            </tr>
          </thead>
          <tbody id="tbody">
          <?php if (empty($result['message'])) { foreach($result as $key=>$value) { ?>
            <tr>
                <td><?php echo $count;$count++ ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['rating']; ?></td>
                <td><?php echo $value['price']; ?></td>
                <td><?php echo $value['discount']; ?></td>
                <td><?php echo $value['brand']; ?></td>
                <td><?php echo $value['color']; ?></td>
                <td><?php echo $value['create_date']; ?></td>
                <td><form action="<?php echo URL;?>product/home.php" method="POST"><input type="submit" class="btn btn-danger pull-right" value="Delete"/>
                    <input type="hidden" name="id" value="<?php echo $value['id']?>"></form></td>
            </tr>
          <?php }} else { ?>
            <tr>
                <td>No result to display</td>
            </tr>
          <?php }?>
          </tbody>
        </table>
      </div>
    </body>
</html>

<script type="text/javascript">
    function showhide() {
        var x = document.getElementById("addDiv");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
    var search = null;

    $(function () {
        $("#brand").keyup(function () {
            var that = this,
            value = $(this).val();

            if (search != null) 
                search.abort();
                search = $.ajax({
                    type: "POST",
                    url: "<?php echo URL;?>product-cart/product/filter.php",
                    data: {
                        'brand' : value,
                        'filterForm': $('#filterForm').val()
                    },
                    dataType: "text",
                    success: function(msg){
                        var obj = JSON.parse(msg);
                        console.log(obj);
                        var j = 1;
                        var str = "";
                        for(var i = 0; i < obj.length; i++) {
                            str += "<tr>";
                            $.each(obj[i], function(key, value) {
                                if (key == "id") {
                                    str = str + "<td>" + j + "</td>";
                                    j++;
                                } else {
                                    str = str + "<td>" + value + "</td>";
                                }
                            });
                            str += "<td><form action='<?php echo URL;?>product/home.php' method='POST'><input type='submit' class='btn btn-danger pull-right' value='Delete'/> <input type='hidden' name='id' value='" + obj[0]['id'] + "'></form></td>";
                            str += "</tr>";
                        }

                        document.getElementById('tbody').innerHTML = str;
                    }
                });
        });
    });
</script>