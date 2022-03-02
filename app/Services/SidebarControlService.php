<?php

namespace App\Services;


class SidebarControlService
{
    // route list
    private $breadcrambs = [

        'all-area'                      => "All Area",
        'edit-area'                     => "Edit Area",
        'create-area'                   => "Create Area",

        'all-line-category'             => "All Line Category",
        'edit-line-category'            => "Edit Line Category",
        'create-line-category'          => "Create Line Category",

        'all-payment-option'            => "All Payment Option",
        'edit-payment-option'           => "Edit Payment Option",
        'create-payment-option'         => "Create Payment Option",

        'all-transaction-type'          => "All Transaction Type",
        'edit-transaction-type'         => "Edit Transaction Type",
        'create-transaction-type'       => "Create Transaction Type",

        'all-staff'                      => "All Staff",
        'edit-staff'                     => "Edit Staff",
        'create-staff'                   => "Create Staff",

        'all-customer'                  => "All Customer",
        'edit-customer'                 => "Edit Customer",
        'create-customer'               => "Create Customer",

        'all-company-info'              => "All Company Info",

        'all-user'                      => "All User",
        'edit-user'                     => "Edit User",
        'create-user'                   => "Create User",

        'all-category'                  => "All Category",
        'edit-category'                 => "Edit Category",
        'create-category'               => "Create Category",

        'all-staff-area'                => "All Staff Assign Area",
        'edit-staff-area'               => "Edit Staff Assign Area",
        'create-staff-area'             => "Create Staff Assign Area",

        'all-account'                   => "All Account",
        'edit-account'                  => "Edit Account",
        'create-account'                => "Create Account",

        'all-address'                   => "All Address",
        'edit-address'                  => "Edit Address",
        'create-address'                => "Create Address",

        'all-client'                    => "All Client",
        'edit-client'                   => "Edit Client",
        'create-client'                 => "Create Client",

        'all-project-item'              => "All Project Item",
        'edit-project-item'             => "Edit Project Item",
        'create-project-item'           => "Create Project Item",

        'all-user-type'                 => "All User Type",
        'edit-user-type'                => "Edit User Type",
        'create-user-type'              => "Create User Type",

        'all-unit-measurement'          => "All Unit Measurement",
        'edit-unit-measurement'         => "Edit Unit Measurement",
        'create-unit-measurement'       => "Create Unit Measurement",

        'all-product-brand'             => "All Product Brand",
        'edit-product-brand'            => "Edit Product Brand",
        'create-product-brand'          => "Create Product Brand",

        'all-product-category'          => "All Product Category",
        'edit-product-category'         => "Edit Product Category",
        'create-product-category'       => "Create Product Category",

        'all-terms-condition'           => "All Terms & Condition",
        'edit-terms-condition'          => "Edit Terms & Condition",
        'create-terms-condition'        => "Create Terms & Condition",


    ];

    public function getBreadCramb()
    {
        $routeName = \Request::route()->getName();

        try {
            return $this->breadcrambs[$routeName];

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
