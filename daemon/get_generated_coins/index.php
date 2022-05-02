<?php
//*desc: Gets the number of coins generated in the chain
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

/*
    Below are coins generated between given blocks as well as running total.
    Those can be verified by running print_coinbase_tx_sum in daemon. See below for examples

    Block #                     Generated since last                Total
    -----------------------------------------------------------------------
    0 - 1                       70.368744177663             70.368744177663
    1 - 2                   180000.0                    180070.368744177663
    2 - 3                       69.681830234395         180140.050574412058
    3 - 4                       69.681564419308         180209.732138831366
    4 - 10                     418.083804455797         180627.815943287163
    10 - 100                  6270.108898963461         186897.924842250624
    100 - 1000               62582.833997755446         249480.758840006070
    1000 - 10000            614151.690162323031         863632.449002329101
    10000 - 100000         5109498.465650588643        5973130.914652917744
    100000 - 200000        3955924.568302007632        9929055.482954925376
    200000 - 300000        2701329.048902004358       12630384.531856929734
    300000 - 400000        1844620.259125159040       14475004.790982088774
    400000 - 500000        1259611.030877990455       15734615.821860079229
    500000 - 600000         860133.598524089211       16594749.420384168440
    600000 - 700000         587347.812386823302       17182097.232770991742
    700000 - 800000         401074.421225557527       17583171.653996549269
    800000 - 900000         273876.260660916411       17857047.914657465680
    900000 - 1000000        187018.260362047905       18044066.175019513585
    1000000 - 1100000       127706.634182142937       18171772.809201656522
    1100000 - 1200000        87205.332361245400       18258978.141562901922
    1200000 - 1300000        59548.733385898464       18318526.874948800386
    1300000 - 1400000        40663.242509540587       18359190.117458340973
    1400000 - 1500000        30469.675373871497       18389659.792832212470
    1500000 - 1600000        29999.997408597206       18419659.790240809676
    1600000 - 1700000        30000.000000000000       18449659.790240809676
    1700000 - 1800000        29999.999845639916       18479659.790086449592
    1800000 - 1900000        30000.000000000000       18509659.790086449592
    1900000 - 2000000        29999.999326824930       18539659.789413274522
    2000000 - 2100000        29999.999921494636       18569659.789334769158


    print_coinbase_tx_sum 100 900       - Coins emitted from block 100, for 900 blocks (block 100 to 1000)
    print_coinbase_tx_sum 200000 100000 - Coins emitted for 100000 blocks starting at block 200000 (blocks 200000 to 300000)

    print_coinbase_tx_sum 1428136 1     - Last block with emission over 0.3 XNV (0.300001065732)
    print_coinbase_tx_sum 1428137 1     - First block in tail emission (0.300000000000 in emissions)

    print_coinbase_tx_sum 2011487 1     - Block with base reward of less than 0.3 XNV: 0.299921494636 + 0.003588000000 in fees. Total reward: 0.303509494636
*/


$checkpoint_block_number = 2100000;
$checkpoint_total_coins = 18569659.7893;        // Rounded to 4 digits after decimal
$reward_per_block = 0.3;                        // We're in tail emission so each block is 0.3 XNV. Not 100%, but close enough

$json = send_json_rpc_request(HOST, DAEMON_PORT, 'get_block_count', null);
$decoded_json = json_decode($json, false);

$current_block_number = $decoded_json->result->count;

// How many blocks since last checkpoint
$block_diff = $current_block_number - $checkpoint_block_number;

// Total coins at checkpoint plus new coins since
echo $checkpoint_total_coins + ($block_diff * $reward_per_block);
?>