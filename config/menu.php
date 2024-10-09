<?php

return [
    'sidebar' => [
        /** SAMPLE AVAILABLE PARAMETER
        [
            'type' => 'tree', // 'group' / 'tree' / 'heading' / 'single'
            'label' => 'Menu Title',
            'icon' => 'fa fa-home',
            'url' => '/',
            'active' => '\View::shared("menu_active") == "user"', // cukup taruh di child nya aja, parent otomatis
            'children' => [],
            'required_configs' => [1,2], // kalau parent tidak ada ketentuan khusus cukup taruh di child nya aja
            'required_configs_rule' => 'or',
            'required_features' => [1,2], // kalau parent tidak ada ketentuan khusus cukup taruh di child nya aja
            'required_features_rule' => 'or',
            'badge' => [
                'type' => 'info', // info | success | warning | danger
                'value' => 'total_home', // for eval
            ],
        ],
        */

        [
            'type' => 'group',
            'label' => 'Home',
            'required_features' => [1],
            'children' => [
                [
                    'type' => 'single',
                    'label' => 'Home',
                    'icon' => 'icon-home',
                    'url' => 'home',
                    'active' => '\View::shared("menu_active") == "home"',
                ],
            ]
        ],

        [
            'type' => 'group',
            'label' => 'Accounts',
            'children' => [
                [
                    'type' => 'tree',
                    'label' => 'User',
                    'icon' => 'icon-home',
                    'children' => [
                        [
                            'label' => 'New User',
                            'active' => '\View::shared("submenu_active") == "user-new"',
                            'url' => 'user/create',
                            'required_features' => [4],
                        ],
                        [
                            'label' => 'User List',
                            'url' => 'user',
                            'required_features' => [2],
                            'active' => '\View::shared("submenu_active") == "user-list"'
                        ],
                        [
                            'label' => 'Deparment List',
                            'url' => 'user/department',
                            'required_features' => [2],
                            'active' => '\View::shared("submenu_active") == "deparment-list"'
                        ],
                        [
                            'label' => 'Log Activity',
                            'active' => '\View::shared("submenu_active") == "user-log"',
                            'url' => 'user/activity',
                            'required_features' => [7],
                        ],
                        [
                            'type' => 'group',
                            'required_configs' => [40],
                            'required_features' => [92],
                            'children' => [
                                [
                                    'label' => '[Response] Pin Sent',
                                    'url' => 'user/autoresponse/pin-sent',
                                    'required_configs' => [41],
                                ],
                                [
                                    'label' => '[Response] Pin Create',
                                    'url' => 'user/autoresponse/pin-create',
                                    'required_configs' => [131],
                                ],
                                [
                                    'label' => '[Response] Pin Verified',
                                    'url' => 'user/autoresponse/pin-verify',
                                    'required_configs' => [42],
                                ],
                                [
                                    'label' => '[Response] Email Verify',
                                    'url' => 'user/autoresponse/email-verify',
                                    'required_configs' => [106],
                                ],
                                [
                                    'label' => '[Response] Pin Changed First Time',
                                    'url' => 'user/autoresponse/pin-changed',
                                    'required_configs' => [43],
                                ],
                                [
                                    'label' => '[Response] Pin Changed Forgot Password',
                                    'url' => 'user/autoresponse/pin-changed-forgot-password',
                                    'required_configs' => [43],
                                ],
                                [
                                    'label' => '[Response] Pin Forgot',
                                    'url' => 'user/autoresponse/pin-forgot',
                                    'required_configs' => [83],
                                ],
                                [
                                    'label' => '[Response] Login Success',
                                    'url' => 'user/autoresponse/login-success',
                                    'required_configs' => [44],
                                ],
                                [
                                    'label' => '[Response] Login Failed',
                                    'url' => 'user/autoresponse/login-failed',
                                    'required_configs' => [45],
                                ],
                                [
                                    'label' => '[Response] Login First Time',
                                    'url' => 'user/autoresponse/login-first-time',
                                    'required_configs' => [43],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'type' => 'group',
            'label' => 'Browse',
            'children' => [
                [
                    'label' => 'Vendor',
                    'type' => 'tree',
                    'icon' => 'fa fa-university',
                    'required_features' => [323,324,325,326,327,348],
                    'children' => [
                        [
                            'label' => 'New Vendor',
                            'url' => 'merchant/create',
                            'active' => '\View::shared("submenu_active") == "merchant-new"',
                            'required_features' => [325],
                        ],
                        [
                            'label' => 'Candidate List',
                            'url' => 'merchant/candidate',
                            'required_features' => [323,324,326,327],
                            'active' => '\View::shared("submenu_active") == "merchant-candidate"',
                           
                        ],
                        [
                            'label' => 'Vendor List',
                            'active' => '\View::shared("submenu_active") == "outlet-list"',
                            'url' => 'outlet/list',
                            'required_features' => [24],
                        ],
                        [
                            'label' => 'Manage Location',
                            'active' => '\View::shared("submenu_active") == "manage-location"',
                            'url' => 'outlet/manage-location',
                            'required_configs' => [2,3],
                            'required_features' => [27],
                        ],
                        [
                            'label' => 'Delivery Vendor Create',
                            'active' => '\View::shared("submenu_active") == "outlet-delivery"',
                            'url' => 'outlet/delivery/create',
                        ],
                        [
                            'label' => 'Tagihan',
                            'url' => 'merchant/withdrawal',
                            'required_features' => [348],
                            'badge' => [
                                'type' => 'warning',
                                'value' => 'withdrawal',
                            ]
                        ],
                        [
                            'label' => '[Response] Register Vendor',
                            'url' => 'autoresponse/merchant/register-merchant',
                            'required_features' => [326],
                        ],
                        [
                            'label' => '[Response] Approve Vendor',
                            'url' => 'autoresponse/merchant/approve-merchant',
                            'required_features' => [326],
                        ],
                        [
                            'label' => '[Response] Rejected Vendor',
                            'url' => 'autoresponse/merchant/rejected-merchant',
                            'required_features' => [326],
                        ],
                        [
                            'label' => '[Response] Penarikan Dana Vendor',
                            'url' => 'autoresponse/merchant/merchant-withdrawal',
                            'required_features' => [326],
                        ]
                    ],
                    
                ],
                [
                    'label' => 'Product',
                    'icon' => 'icon-wallet',
                    'type' => 'tree',
                    'required_features' => [43,44,45,46,47,48,49,50,51,52],
                    'children' => [
                        [
                            'label' => 'Category List',
                            'active' => '\View::shared("submenu_active") == "product-category-list"',
                            'url' => 'product/category',
                            'required_features' => [43,44,45,46,47],
                        ],
                        [
                            'label' => 'New Product',
                            'url' => 'product/create',
                            'required_features' => [50],
                        ],
                        [
                            'label' => 'Product List',
                            'active' => '\View::shared("submenu_active") == "product-list"',
                            'url' => 'product',
                            'required_features' => [48],
                        ],
                        [
                            'label' => 'Verification Product',
                            'active' => '\View::shared("submenu_active") == "product-list-inactive"',
                            'url' => 'product/inactive',
                            'required_features' => [48],
                        ],
                        [
                            'required_features' => [48],
                            'type' => 'group',
                            'children' => [
                                [
                                    'label' => 'Visible Product List',
                                    'required_features' => [51],
                                    'active' => '\View::shared("submenu_active") == "product-list-visible"',
                                    'url' => 'product/visible'
                                ],
                                [
                                    'label' => 'Hidden Product List',
                                    'required_features' => [51],
                                    'active' => '\View::shared("submenu_active") == "product-list-hidden"',
                                    'url' => 'product/hidden'
                                ],
                                [
                                    'label' => 'Product Photo Default',
                                    'required_features' => [51],
                                    'active' => '\View::shared("submenu_active") == "product-photo-default"',
                                    'url' => 'product/photo/default'
                                ],
                                [
                                    'label' => 'Product Recommendation',
                                    'required_features' => [51],
                                    'active' => '\View::shared("submenu_active") == "product-recommendation"',
                                    'url' => 'product/recommendation'
                                ],
                            ],
                        ]
                    ]
                ],
                [
                    'label' => 'User Rating',
                    'type' => 'tree',
                    'icon' => 'icon-star',
                    'children' => [
                        [
                            'label' => 'User Rating List',
                            'url' => 'user-rating',
                            'required_features' => [352],
                        ],
                        [
                            'label' => 'User Rating Report Product',
                            'required_features' => [352],
                            'active' => '\View::shared("submenu_active") == "user-rating-report-product"',
                            'url' => 'user-rating/report/product'
                        ],
                        
                        [
                            'label' => '[Response] Rating Product',
                            'required_features' => [353],
                            'url' => 'user-rating/autoresponse/product',
                            'active' => '\View::shared("submenu_active") == "user-rating-response-product"',
                        ],
                    ]
                ],
                
                [
                    'label' => 'Product Variant (SKU)',
                    'required_features' => [],
                    'type' => 'tree',
                    'children' => [
                        [
                            'label' => 'New Variant',
                            'required_features' => [279],
                            'url' => 'product-variant/create'
                        ],
                        [
                            'type' => 'group',
                            'required_features' => [278, 279, 281],
                            'children' => [
                                [
                                    'label' => 'Variant List',
                                    'required_features' => [],
                                    'active' => '\View::shared("submenu_active") == "product-variant-list"',
                                    'url' => 'product-variant'
                                ],
                                [
                                    'label' => 'Variant Position',
                                    'required_features' => [],
                                    'active' => '\View::shared("submenu_active") == "product-variant-position"',
                                    'url' => 'product-variant/position'
                                ],
                                [
                                    'label' => 'Remove Product Variant (SKU)',
                                    'required_features' => [],
                                    'active' => '\View::shared("submenu_active") == "product-variant-group-remove"',
                                    'url' => 'product-variant-group/list-group'
                                ],
                                [
                                    'label' => 'Product Variant (SKU) List',
                                    'required_features' => [],
                                    'active' => '\View::shared("submenu_active") == "product-variant-group-list"',
                                    'url' => 'product-variant-group/list'
                                ],
                                [
                                    'label' => 'Product Variant (SKU) Price',
                                    'required_features' => [],
                                    'active' => '\View::shared("submenu_active") == "product-variant-group-price"',
                                    'url' => 'product-variant-group/price'
                                ],
                                [
                                    'label' => 'Product Variant (SKU) Detail',
                                    'required_features' => [],
                                    'active' => '\View::shared("submenu_active") == "product-variant-group-detail"',
                                    'url' => 'product-variant-group/detail'
                                ],
                                [
                                    'label' => 'Export & Import',
                                    'required_features' => [],
                                    'type' => 'tree',
                                    'children' => [
                                        [
                                            'label' => 'Import Variant',
                                            'required_features' => [],
                                            'active' => '\View::shared("submenu_active") == "product-variant-import-global"',
                                            'url' => 'product-variant/import'
                                        ],
                                        [
                                            'label' => 'Import Product Variant (SKU)',
                                            'required_features' => [],
                                            'active' => '\View::shared("submenu_active") == "product-variant-group-import-global"',
                                            'url' => 'product-variant-group/import'
                                        ],
                                        [
                                            'label' => 'Import Product Variant (SKU) Price',
                                            'required_features' => [],
                                            'active' => '\View::shared("submenu_active") == "product-variant-group-import-price"',
                                            'url' => 'product-variant-group/import-price'
                                        ],
                                    ],
                                ],
                            ]
                        ],
                    ],
                    'icon' => 'fa fa-coffee'
                ],
            ],
        ],
        [
            'type' => 'group',
            'label' => 'Order',
            'children' => [
                [
                    'type' => 'tree',
                    'label' => 'Transaction',
                    'icon' => 'fa fa-shopping-cart',
                    'children' => [
                        [
                            'label' => 'Pending',
                            'required_features' => [69],
                            'active' => '\View::shared("submenu_active") == "transaction-pending"',
                            'url' => 'transaction',
                            
                        ],
                        [
                            'label' => 'On Process',
                            'required_features' => [69],
                            'active' => '\View::shared("submenu_active") == "transaction-process"',
                            'url' => 'transaction/process',
                           
                        ],
                        [
                            'label' => 'Terkirim',
                            'required_features' => [69],
                            'active' => '\View::shared("submenu_active") == "transaction-delivery"',
                            'url' => 'transaction/delivery',
                            
                        ],
                        [
                            'label' => 'Completed',
                            'required_features' => [69],
                            'active' => '\View::shared("submenu_active") == "transaction-completed"',
                            'url' => 'transaction/completed'
                        ],
                        [
                            'label' => 'Cancel',
                            'required_features' => [69],
                            'active' => '\View::shared("submenu_active") == "transaction-cancel"',
                            'url' => 'transaction/cancel'
                        ],
                    ],
                    
                ],
                [
                    'type' => 'tree',
                    'label' => 'Transaction Group',
                    'icon' => 'fa fa-money',
                    'children' => [
                        [
                            'label' => 'Pending',
                            'required_features' => [69],
                            'active' => '\View::shared("submenu_active") == "transaction-group"',
                            'url' => 'transaction/group',
                        ],
                        [
                            'label' => 'Belum Dibayar',
                            'required_features' => [69],
                            'active' => '\View::shared("submenu_active") == "transaction-group-unpaid"',
                            'url' => 'transaction/group/unpaid',
                        ],
                        [
                            'label' => 'Completed',
                            'required_features' => [69],
                            'active' => '\View::shared("submenu_active") == "transaction-group-completed"',
                            'url' => 'transaction/group/completed',
                        ],
                        [
                            'label' => 'Rejected',
                            'required_features' => [69],
                            'active' => '\View::shared("submenu_active") == "transaction-group-rejected"',
                            'url' => 'transaction/group/rejected',
                        ],
                    ],
                    
                ],
                [
                    'type' => 'tree',
                    'label' => 'Auto Response',
                    'icon' => 'icon-action-undo',
                    'children' => [
                        [
                            'label' => 'Transaction Callback Xendit',
                            'required_features' => [93],
                            'active' => '\View::shared("submenu_active") == "transaction-autoresponse-transaction-callback-xendit"',
                            'url' => 'transaction/autoresponse/transaction-callback-xendit'
                        ],
                        [
                            'label' => 'Payment Status',
                            'required_features' => [93],
                            'active' => '\View::shared("submenu_active") == "transaction-autoresponse-payment-status"',
                            'url' => 'transaction/autoresponse/payment-status'
                        ],
                        [
                            'label' => ' Vendor Transaction New',
                            'required_features' => [93],
                            'active' => '\View::shared("submenu_active") == "transaction-autoresponse-merchant-transaction-new"',
                            'url' => 'transaction/autoresponse/merchant-transaction-new'
                        ],
                        [
                            'label' => 'Transaction Accepted',
                            'required_features' => [93],
                            'active' => '\View::shared("submenu_active") == "transaction-autoresponse-transaction-accepted"',
                            'url' => 'transaction/autoresponse/transaction-accepted'
                        ],
                        [
                            'label' => 'Transaction Reject',
                            'required_features' => [93],
                            'active' => '\View::shared("submenu_active") == "transaction-autoresponse-transaction-reject"',
                            'url' => 'transaction/autoresponse/transaction-reject'
                        ],
                        [
                            'label' => 'Transaction Delivery Confirm',
                            'required_features' => [93],
                            'active' => '\View::shared("submenu_active") == "transaction-autoresponse-transaction-delivery-confirm"',
                            'url' => 'transaction/autoresponse/transaction-delivery-confirm'
                        ],
                        [
                            'label' => 'Delivery Status Update',
                            'required_features' => [93],
                            'active' => '\View::shared("submenu_active") == "delivery-status-update"',
                            'url' => 'transaction/autoresponse/delivery-status-update'
                        ],
                        [
                            'label' => 'Transaction Delivery Received',
                            'required_features' => [93],
                            'active' => '\View::shared("submenu_active") == "transaction-autoresponse-transaction-delivery-received"',
                            'url' => 'transaction/autoresponse/transaction-delivery-received'
                        ],
                        [
                            'label' => 'Transaction Completed',
                            'required_features' => [93],
                            'active' => '\View::shared("submenu_active") == "transaction-autoresponse-transaction-success"',
                            'url' => 'transaction/autoresponse/transaction-success'
                        ],
                        [
                            'label' => 'Transaction Point Achievement',
                            'required_features' => [93],
                            'url' => 'transaction/autoresponse/transaction-point-achievement'
                        ],
                        [
                            'label' => 'Pembayaran Tagihan',
                            'required_features' => [93],
                            'url' => 'transaction/autoresponse/pembayaran-tagihan'
                        ],
                        [
                            'label' => 'Reminder Pembayaran Tagihan',
                            'required_features' => [93],
                            'url' => 'transaction/autoresponse/reminder-pembayaran-tagihan'
                        ]
                    ],
                ],
                [
                    'label' => 'Failed Void Payment',
                    'required_features' => [299],
                    'active' => '\View::shared("menu_active") == "failed-void-payment"',
                    'url' => 'transaction/failed-void-payment',
                    'icon' => 'fa fa-exclamation-triangle'
                ],
                [
                        'label' => 'Points History',
                        'required_features' => [93],
                        'active' => '\View::shared("menu_active") == "balance"',
                        'url' => 'transaction/balance',
                        'icon' => 'fa fa-clock-o'
                ],
                [
                    'type' => 'tree',
                    'label' => 'Order Settings',
                    'icon' => 'fa fa-cogs',
                    'children' => [
                        [
                            'label' => 'Setting Fee',
                            'required_features' => [250],
                            'active' => '\View::shared("submenu_active") == "setting-fee"',
                            'url' => 'transaction/setting/all-fee'
                        ],
                        [
                            'label' => 'Setting Reminder',
                            'required_features' => [250],
                            'active' => '\View::shared("submenu_active") == "setting-reminder"',
                            'url' => 'transaction/setting/all-reminder'
                        ],
                        [
                            'label' => 'Sumber Dana',
                            'active' => '\View::shared("submenu_active") == "setting-sumber-dana"',
                            'url' => 'sumber-dana'
                        ],
                        [
                            'label' => 'Available Payment Method',
                            'required_features' => [250],
                            'active' => '\View::shared("submenu_active") == "setting-payment-method"',
                            'url' => 'transaction/setting/available-payment'
                        ],
                        [
                            'label' => 'Setting Refund Reject Order',
                            'required_features' => [250],
                            'active' => '\View::shared("submenu_active") == "refund-reject-order"',
                            'url' => 'transaction/setting/refund-reject-order'
                        ]
                    ]
                ],
            ]
        ],

        [
            'type' => 'group',
            'label' => 'Settings',
            'children' => [
                [
                    'label' => 'Banner & Splash Screen',
                    'required_features' => [15, 16, 17, 18, 144, 145, 146, 147, 241, 246],
                    'active' => '\View::shared("menu_active") == "setting-home"',
                    'url' => 'setting/home',
                    'icon' => 'icon-screen-tablet '
                ],
                [
                    'label' => 'Setting Invoice',
                    'active' => '\View::shared("menu_active") == "setting-invoice"',
                    'url' => 'setting/invoice',
                    'icon' => 'fa fa-money'
                ],
                [
                    'label' => 'Link CS',
                    'active' => '\View::shared("menu_active") == "crm-setting-whatsapp"',
                    'url' => 'setting/cs',
                    'icon' => 'fa fa-whatsapp'
                ],
                [
                    'label' => 'Setting Phone Number',
                    'required_features' => [210],
                    'required_configs' => [94],
                    'active' => '\View::shared("menu_active") == "setting-phone"',
                    'url' => 'setting/phone',
                    'icon' => 'fa fa-phone'
                ],
                [
                    'label' => 'Text Menu',
                    'required_features' => [160],
                    'active' => '\View::shared("menu_active") == "setting-text-menu"',
                    'url' => 'setting/text_menu',
                    'icon' => 'fa fa-bars'
                ],
                [
                    'label' => 'Fraud Detection',
                    'required_features' => [],
                    'type' => 'tree',
                    'children' => [
                        [
                            'label' => 'Fraud Detection Settings',
                            'required_features' => [192],
                            'active' => '\View::shared("submenu_active") == "fraud-detection-update"',
                            'url' => 'setting-fraud-detection'
                        ],
                        [
                            'label' => 'Report Fraud Device',
                            'required_features' => [193],
                            'active' => '\View::shared("submenu_active") == "report-fraud-device"',
                            'url' => 'fraud-detection/report/device'
                        ],
                        [
                            'label' => 'Report Fraud Transaction Day',
                            'required_features' => [194],
                            'active' => '\View::shared("submenu_active") == "report-fraud-transaction-day"',
                            'url' => 'fraud-detection/report/transaction-day'
                        ],
                        [
                            'label' => 'Report Fraud Transaction Week',
                            'required_features' => [195],
                            'active' => '\View::shared("submenu_active") == "report-fraud-transaction-week"',
                            'url' => 'fraud-detection/report/transaction-week'
                        ],
                        [
                            'label' => 'Report Fraud Transaction in Between',
                            'required_features' => [215],
                            'active' => '\View::shared("submenu_active") == "report-fraud-transaction-between"',
                            'url' => 'fraud-detection/report/transaction-between'
                        ],
                        [
                            'label' => 'Report Fraud Referral User',
                            'required_features' => [217],
                            'required_configs' => [115],
                            'active' => '\View::shared("submenu_active") == "report-fraud-referral-user"',
                            'url' => 'fraud-detection/report/referral-user'
                        ],
                        [
                            'label' => 'Report Fraud Referral',
                            'required_features' => [218],
                            'active' => '\View::shared("submenu_active") == "report-fraud-referral"',
                            'url' => 'fraud-detection/report/referral'
                        ],
                        [
                            'label' => 'Report Fraud Promo Code',
                            'required_features' => [219],
                            'active' => '\View::shared("submenu_active") == "report-fraud-promo-code"',
                            'url' => 'fraud-detection/report/promo-code'
                        ],
                        [
                            'label' => 'List User Fraud',
                            'required_features' => [196],
                            'active' => '\View::shared("submenu_active") == "suspend-user"',
                            'url' => 'fraud-detection/suspend-user'
                        ],
                    ],
                    'icon' => 'fa fa-exclamation'
                ],
                [
                    'label' => 'Version Control',
                    'required_features' => [354],
                    'active' => '\View::shared("menu_active") == "setting-version"',
                    'url' => 'version',
                    'icon' => 'fa fa-info-circle'
                ],
                [
                    'label' => 'Custom Page',
                    'required_features' => [],
                    'type' => 'tree',
                    'children' => [
                        [
                            'label' => 'New Custom Page',
                            'required_features' => [150],
                            'url' => 'custom-page/create'
                        ],
                        [
                            'label' => 'Custom Page List',
                            'required_features' => [149,151,152,153],
                            'active' => '\View::shared("submenu_active") == "custom-page-list"',
                            'url' => 'custom-page'
                        ],
                    ],
                    'icon' => 'icon-book-open'
                ],
                [
                    'label' => 'Intro Apps',
                    'required_features' => [168],
                    'required_configs' => [108],
                    'type' => 'tree',
                    'children' => [
                        [
                            'label' => 'Intro First Install',
                            'url' => 'setting/intro/first'
                        ]
                    ],
                    'icon' => 'icon-screen-tablet'
                ],
                [
                    'label' => 'Confirmation Messages',
                    'required_features' => [162,163],
                    'url' => 'setting/confirmation-messages',
                    'icon' => 'icon-speech'
                ],
                [
                    'label' => 'Maintenance Mode',
                    'required_features' => [220],
                    'url' => 'setting/maintenance-mode',
                    'icon' => 'icon-wrench'
                ],
                [
                    'label' => 'Time Expired OTP and Email',
                    'required_features' => [251,252],
                    'url' => 'setting/time-expired',
                    'icon' => 'fa fa-envelope'
                ],
            ],
        ],
        [
            'type' => 'group',
            'label' => 'CRM',
            'children' => [
                [
                    'label' => 'CRM Setting',
                    'required_features' => [],
                    'icon' => 'icon-settings',
                    'type' => 'tree',
                    'children' => [
                        [
                            'label' => 'Text Replace',
                            'required_features' => [96],
                            'active' => '\View::shared("submenu_active") == "textreplace"',
                            'url' => 'textreplace'
                        ],
                        [
                            'label' => 'Email Header & Footer',
                            'required_features' => [97],
                            'active' => '\View::shared("submenu_active") == "email"',
                            'url' => 'email-header-footer'
                        ]
                    ]
                ],
                [
                    'label' => 'Contact Us',
                    'required_features' => [83,84],
                    'active' => '\View::shared("submenu_active") == "enquiries-list"',
                    'url' => 'enquiries',
                    'icon' => 'icon-action-undo'
                ],
                [
                    'label' => 'Forward Contact Us',
                    'required_features' => [83,84],
                    'active' => '\View::shared("submenu_active") == "contact-us-autoresponse-forward-contact-us"',
                    'url' => 'autoresponse/contact-us/forward-contact-us',
                    'icon' => 'icon-action-undo'
                ],
            ]
        ],
        [
            'type' => 'group',
            'label' => 'About',
            'children' => [
                [
                    'label' => 'FAQ',
                    'required_features' => [],
                    'type' => 'tree',
                    'children' => [
                        [
                            'label' => 'New FAQ',
                            'required_features' => [89],
                            'url' => 'setting/faq/create'
                        ],
                        [
                            'label' => 'List FAQ',
                            'required_features' => [88],
                            'active' => '\View::shared("submenu_active") == "faq-list"',
                            'url' => 'setting/faq'
                        ],
                        [
                            'label' => 'Sorting FAQ List',
                            'required_features' => [88],
                            'active' => '\View::shared("submenu_active") == "faq-sort"',
                            'url' => 'setting/faq/sort'
                        ],
                    ],
                    'icon' => 'icon-question'
                ],
                
            ],
        ],
    ],
];
