<script src=<?=base_url("/Scripts/jquery-1.5.1.min.js")?>   type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // Document.ready -> link up remove event handler
        $(".RemoveLink").click(function () {
            // Get the id from the link
            var recordToDelete = $(this).attr("data-id");
            if (recordToDelete != '') {
                // Perform the ajax post $.post
				//win7 & XP 在路徑上的定義又不同,只好在index.php 上動手
				$.post(<?=constant("MYPOST");?>, { "id": recordToDelete },
                    function (data) {
                        // Successful requests get here
                        // Update the page elements
                        if (data.ItemCount == 0) {
                            $('#row-' + data.DeleteId).fadeOut('slow');
                        } else {
                            $('#item-count-' + data.DeleteId).text(data.ItemCount);
                        }

                        $('#cart-total').text(data.CartTotal);
                        $('#update-message').text(data.Message);
                        $('#cart-status').text('Cart (' + data.CartCount + ')');
                    });
            }
        });

    });


    function handleUpdate() {
        // Load and deserialize the returned JSON data
        var json = context.get_data();
        var data = Sys.Serialization.JavaScriptSerializer.deserialize(json);

        // Update the page elements
        if (data.ItemCount == 0) {
            $('#row-' + data.DeleteId).fadeOut('slow');
        } else {
            $('#item-count-' + data.DeleteId).text(data.ItemCount);
        }

        $('#cart-total').text(data.CartTotal);
        $('#update-message').text(data.Message);
        $('#cart-status').text('Cart (' + data.CartCount + ')');
    }
</script>

<h3>
    <em>Review</em> your cart:
</h3>
<p class="button">
	<?=anchor("checkout_controller/"   ,"Checkout >>") ?>
</p>
<div id="update-message">
</div>
<table>
    <tr>
        <th>
            Album Name
        </th>
        <th>
            Price (each)
        </th>
        <th>
            Quantity
        </th>
        <th></th>
    </tr>
	<?php	
	if($cart_items <> FALSE)
	{
		foreach($cart_items as $item)
		{
			echo "<tr id='row-" . $item["RecordId"] . "'>";		
			echo "<td>" . anchor("store_controller/details/" . $item["AlbumId"],$item["Title"])  . "</td>";
			echo "<td>" . $item["Price"] . "</td>";
			echo "<td id=item-count-" . $item["RecordId"] . ">" . $item["Count"] . "</td>";
			echo "<td><a href='#' class='RemoveLink' data-id=" . $item["RecordId"] 
					. ">Remove from cart </a></td>" ;		
			echo "</tr>".chr(13).chr(10);		
		}	
	}
	?>
	<tr>
        <td>
            Total
        </td>
        <td>
        </td>
        <td>
        </td>
        <td id="cart-total">
            <?php 
				if($cart_items <> false)
				{
					echo $cart_items[0]["CartTotal"] ;
				}
				else
				{
					echo 0;
				}
			?>
        </td>
    </tr>
</table>	
