<?php
/**
 * Loop Property Template: Search
 *
 * @package     EPL
 * @subpackage  Templates/Content
 * @copyright   Copyright (c) 2015, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
global $property;

$auction = $property->get_property_meta('property_auction') != '' ? date('n/j/y',strtotime($property->get_property_meta('property_auction'))) : '';
$auction_2 = $property->get_property_meta('property_auction_2') != '' ? date('n/j/y',strtotime($property->get_property_meta('property_auction_2')) ) : '';
$str_auc = $property->get_property_meta('property_auction') != '' ? strtotime($property->get_property_meta('property_auction')) : '';
$str_auc_2 = $property->get_property_meta('property_auction_2') != '' ? strtotime($property->get_property_meta('property_auction_2')) : '';
?>

<tr id="post-<?php the_ID(); ?>" class="hi-property-detail">
	<td class="hi-property-detail-item hide">
		<?php echo ucwords($property->get_property_meta('property_status'));?>
	</td>
	<td class="hi-property-detail-item hide">
		<?php echo ucwords(str_replace('-',' ',$property->get_property_meta('property_category')));?>
	</td>
	<td class="hi-property-detail-item">
		<a href="<?php the_permalink() ?>" title="<?php echo __('Go to Property','easy-property-listings');?>">
			<?php echo ucwords($property->get_property_meta('property_address_street'));?>
		</a>
	</td>
	<td class="hi-property-detail-item">
		<?php echo ucwords($property->get_property_meta('property_address_suburb'));?>
	</td>
	<td class="hi-property-detail-item hi-center">
		<?php echo $property->get_property_meta('property_bedrooms');?>
	</td>
	<td class="hi-property-detail-item hi-center">
		<?php echo $property->get_property_meta('property_bathrooms');?>
	</td>
	<td class="hi-property-detail-item hi-center hide">
		<?php echo $property->get_property_meta('property_custom_interior_area');?>
	</td>
	<td class="hi-property-detail-item hi-center hide">
		<?php echo $property->get_property_meta('property_custom_land_area');?>
	</td> 
	<td class="hi-property-detail-item hi-center hide">
		<?php echo ucwords($property->get_property_meta('property_custom_tenure'));?>
	</td>
	<td class="hi-property-detail-item hi-center">
		<?php echo epl_currency_formatted_amount(($property->get_property_meta('property_custom_opening_bid')));?>
	</td>
	<td class="hi-property-detail-item hi-center hide">
		<?php echo epl_currency_formatted_amount(($property->get_property_meta('property_custom_current_bid')));?>
	</td>
	<td class="hi-property-detail-item hide hi-center">
		<?php echo epl_currency_formatted_amount(($property->get_property_meta('property_custom_market_value')));?>
	</td>
	<td data-value="<?php echo $str_auc; ?>" class="hi-property-detail-item hi-right hide">
		<?php echo $auction; ?>
	</td>
	<td data-value="<?php echo $str_auc_2; ?>" class="hi-property-detail-item hi-right hide">
		<?php echo $auction_2; ?>
	</td>
</tr>