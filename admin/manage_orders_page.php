<?php 
    include('./php/config.php');
    include('./php/manage_orders.php');

    // Fetch all products and categories from the database
    $orders = getAllOrders();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ref/css/styles.css">
    <link rel="stylesheet" href="../ref/css/tailwind.min.css">
    <link rel="stylesheet" href="../ref/css/extended.css">
    <title>Document</title>
</head>
<body class="font-rubik">
    <div class="p-4 sm:ml-64">
        <div class="h-full p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <h2 class="text-xl font-bold select-none">Manage Orders</h2>
        </div>
    </div>

    <div class="p-4 sm:ml-64">
        <div class="h-full p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <!-- Orders List -->
            <h4 class="mb-2 font-semibold text-md ">Orders List</h4>
            <div class="overflow-auto">
                <table class="table table-zebra" border="1">
                    <thead class="text-sm font-semibold">
                        <tr>
                            <th>Order Id</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Order Date</th>
                            <th>Total Amount</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th class="w-28">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //Mengurutkan order secara descend
                            usort($orders, fn($a, $b) => $b['order_id'] <=> $a['order_id']);
                            
                            foreach ($orders as $order) : 
                        ?>
                            <a href="">
                                <tr>
                                    <td class=""><?php echo $order['order_id']; ?></td>
                                    <td><?php echo $order['full_name']; ?></td>
                                    <td class="sm:text-justify"><?php echo $order['email']; ?></td>
                                    <td class="sm:text-justify"><?php echo $order['phone_no']; ?></td>
                                    <td>
                                        <?php echo $order['main_address'] .' <br> '. $order['postal_code'] . ' <br> ' . $order['city'] .' <br> '. $order['state']; ?>
                                    </td>
                                    <td><?php echo $order['order_date']; ?></td>
                                    <td>Rp&nbsp<?php echo number_format($order['total_amount'], 2); ?></td>
                                    <td>
                                        <?php 
                                            if ($order['payment'] != null) {
                                                echo '<img src="' . $order['payment'] . '" alt="user_payment">';
                                            } else {
                                                echo '<p class="text-red-500">Not yet Paid</p>';
                                            }
                                        ?>  
                                    </td>
                                    <td>
                                        <?php 
                                        if ($order['status'] == 'pending'){
                                            echo '<p class = "text-yellow-500">' . $order['status'] . '</p>';
                                        }
                                        else if ($order['status'] == 'rejected') {
                                            echo '<p class = "text-red-500">' . $order['status'] . '</p>';
                                        }
                                        else {
                                            echo '<p class = "text-green-500">' . $order['status'] . '</p>';
                                        }?>
                                    </td>
                                    <td >
                                        <a class="hover:underline" href="./view_order_details_page.php?action=view&order_id=<?php echo $order['order_id']; ?>">Details</a> | 
                                        <a class="hover:underline" href="./php/manipulate_orders.php?action=confirm&order_id=<?php echo $order['order_id']; ?>">Confirm</a> | 
                                        <a class="text-red-400 transition-colors hover:underline hover:text-red-700" href="./php/manipulate_orders.php?action=reject&order_id=<?php echo $order['order_id']; ?>" onclick="return confirm('Are you sure you want to reject this order?')">Cancel</a>
                                    </td>
                                </tr>
                            </a>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>   
        </div>
    </div>
</body>
</html>