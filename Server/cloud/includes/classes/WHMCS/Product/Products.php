<?php //00e57
// *************************************************************************
// *                                                                       *
// * WHMCS - The Complete Client Management, Billing & Support Solution    *
// * Copyright (c) WHMCS Ltd. All Rights Reserved,                         *
// * Version: 5.3.14 (5.3.14-release.1)                                    *
// * BuildId: 0866bd1.62                                                   *
// * Build Date: 28 May 2015                                               *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: info@whmcs.com                                                 *
// * Website: http://www.whmcs.com                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.  This software  or any other *
// * copies thereof may not be provided or otherwise made available to any *
// * other person.  No title to and  ownership of the  software is  hereby *
// * transferred.                                                          *
// *                                                                       *
// * You may not reverse  engineer, decompile, defeat  license  encryption *
// * mechanisms, or  disassemble this software product or software product *
// * license.  WHMCompleteSolution may terminate this license if you don't *
// * comply with any of the terms and conditions set forth in our end user *
// * license agreement (EULA).  In such event,  licensee  agrees to return *
// * licensor  or destroy  all copies of software  upon termination of the *
// * license.                                                              *
// *                                                                       *
// * Please see the EULA file for the full End User License Agreement.     *
// *                                                                       *
// *************************************************************************
/**
 * Interface for admin configured products
 *
 * @author     WHMCS Limited <development@whmcs.com>
 * @copyright  Copyright (c) WHMCS Limited 2005-2014
 * @license    http://www.whmcs.com/license/ WHMCS Eula
 */
class WHMCS_Product_Products
{
    /**
     * Returns the product list for a given product group
     *
     * Product Group ID can be be omitted to return all products
     *
     * Products are returned in the admin configured display order,
     * sorted first by product group order, then product order,
     * and lastly product name if no custom ordering is defined
     *
     * @param int $groupId
     *
     * @return array
     */
    public function getProducts($groupId = null)
    {
        $where = array(  );
        if( $groupId )
        {
            $where["tblproducts.gid"] = (int) $groupId;
        }
        $products = array(  );
        $result = select_query('tblproducts', "tblproducts.id, tblproducts.gid, tblproducts.name," . "tblproducts.retired, tblproductgroups.name AS groupname", $where, "tblproductgroups`.`order` ASC, `tblproducts`.`order` ASC, `name", 'ASC', '', "tblproductgroups ON tblproducts.gid=tblproductgroups.id");
        while( $data = mysql_fetch_assoc($result) )
        {
            $products[] = $data;
        }
        return $products;
    }
}