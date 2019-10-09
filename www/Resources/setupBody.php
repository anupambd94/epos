<div class="container">
    <!-- printer setup start -->
    <!-- <input type="checkbox" name="tag_1" id="tag_1" value="yes" <?php echo ($dbvalue['tag_1']==1 ? 'checked' : '');?>> -->
    <h5>Printer Setting :</h5>
    <div class="row border-inner" >
        <div class="col-sm-8">
        <div class="input-group mb-3">
            <div class="input-group-prepend bg-local">
                <label class="input-group-text" for="inputGroupSelect01">Printer Name</label>
            </div>
            <input type="text" value="<?php echo $shareName ?>" name="shareName" id="inputGroupSelect01" style="width:400px; padding:2px 5px;" class="custom-input" placeholder="Printer Share Name" aria-label="Username" aria-describedby="basic-addon1">

            </div>
        </div>
        <div class="col-sm-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend bg-local">
                    <span class="input-group-text" id="basic-addon1">Print Copies</span>
                </div>
                <input type="number" name="copies" value="<?php echo $printerCopies ?>" class="form-control" placeholder="Print Copies" aria-label="Username" aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <!-- printer setup end -->


<br>
    <!-- Kitchen Receipt settings start -->
    <h5>kitchen receipt setting :</h5>
    <br>
    <div class="row border-inner" >
        
        <div class="col-sm-12">
            <div class="row">
                    <div class="col-sm-4">
                        <label class="container">
                            <input type="checkbox" id="dishPrise" name="dishPrise" value="<?php echo $showDishPrize ?>" <?php echo ($showDishPrize == 1 ? 'checked' : '');?> >
                            <span class="checkmark"></span>Show Dish Price
                        </label>
                        <label class="container">
                            <input type="checkbox" id="paymentMetnod" name="paymentMetnod" value="<?php echo $showPaymentMethod ?>" <?php echo ($showPaymentMethod == 1 ? 'checked' : '');?>>
                            <span class="checkmark"></span>Show Payment Method
                        </label>
                    </div>
                    <div class="col-sm-4">
                        <label class="container" >
                            <input type="checkbox" id="dishFont" name="dishFont" value="<?php echo $dishFondBold ?>" <?php echo ($dishFondBold == 1 ? 'checked' : '');?>>
                            <span class="checkmark"></span>Dish Font Bold
                        </label>
                        <label class="container">
                            <input type="checkbox" id="address" name="address" value="<?php echo $showAddress ?>" <?php echo ($showAddress == 1 ? 'checked' : '');?>>
                            <span class="checkmark"></span>Show Address(collection)
                        </label>
                    </div>
                    <div class="col-sm-4">
                        <label class="container" >
                            <input type="checkbox" id="amount" name="amount" value="<?php echo $showTotalAmount ?>" <?php echo ($showTotalAmount == 1 ? 'checked' : '');?>>
                            <span class="checkmark"></span>Show Total Amount
                        </label>
                        <label class="container" >
                            <input type="checkbox" id="RAddress" name="RAddress" value="<?php echo $showRAddress ?>" <?php echo ($showRAddress == 1 ? 'checked' : '');?>>
                            <span class="checkmark"></span>Show restaurant Address
                        </label>
                    </div>
            </div>
        </div>

    </div>
    <!-- Kitchen Receipt settings end -->

    <br><br><br>

    <div class="row">
    
        <div class="col-md-4"></div>
        <div class="col-md-4 mb-3">
            <!-- <a type="button" class="form-control btn btn-primery" >Save</a> -->
            <input type="submit"  class="fadeIn fourth" style="width: 300px;" value="Save" name="submit">
        </div>
    
    </div>
<!-- Other setings end -->
</div>

<script>
    
    // $(document).on('change', 'input:checkbox', function (e) {
    //     var $this = $(this);

    //         if($this.is(":checked")){
    //             console.log($this.attr("id"));
    //         }else{
    //             console.log($this.attr("id"));                
    //         }
    // });    
        
    </script>