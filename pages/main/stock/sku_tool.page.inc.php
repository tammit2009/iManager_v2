
<div class="row">
    <div class="col-md-6"> 

        <div id="sku_the_result"></div>
        
        <div class="dashboard card my-4">
            <div class="card-body">
                
                <form id="sku_tool_form" action="main.php?dir=stock&page=sku_tool" method="post">    
                    <div class="form-group">             
                        <label for="">Brand</label>
                        <input type="text" name="brand" id="brand" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Category</label>
                        <input type="text" name="category" id="category" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Packaging</label>
                        <input type="text" name="package" id="package" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Number</label>
                        <input type="text" name="number" id="number" class="form-control form-control-sm">
                    </div>
                        
                    <div class="col-lg-12 text-right justify-content-center d-flex">
                        <button class="btn btn-primary mr-2" type="submit">Get SKU</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

<script>
$(document).ready(function(){
    $('#sku_tool_form').submit(function(e) {
        e.preventDefault();

        var form_data = $("#sku_tool_form").serializeArray(); 
        createSKU(form_data);
    });
});
</script>
