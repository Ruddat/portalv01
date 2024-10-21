<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Main</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('index', '/', 'sales-dashboard') ? 'active subdrop' : '' }}"><i
                                    data-feather="grid"></i><span>Dashboard</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ url('index') }}"
                                        class="{{ Request::is('index', '/') ? 'active' : '' }}">Admin Dashboard</a></li>
                                <li><a href="{{ url('sales-dashboard') }}"
                                        class="{{ Request::is('sales-dashboard') ? 'active' : '' }}">Sales Dashboard</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('chat', 'file-manager', 'file-archived','file-document','file-favourites','file-manager-seleted','file-recent','file-shared','notes', 'todo', 'email', 'calendar', 'call-history', 'audio-call', 'video-call','file-manager-deleted') ? 'active subdrop' : '' }} "><i
                                    data-feather="smartphone"></i><span>Application</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ url('chat') }}"
                                        class="{{ Request::is('chat') ? 'active' : '' }}">Chat</a></li>
                                <li class="submenu submenu-two"><a href="javascript:void(0);"
                                        class="{{ Request::is('video-call', 'audio-call', 'call-history') ? 'active subdrop' : '' }}">Call<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a class="{{ Request::is('video-call') ? 'active' : '' }}"
                                                href="{{ url('video-call') }}">Video Call</a></li>
                                        <li><a class="{{ Request::is('audio-call') ? 'active' : '' }}"
                                                href="{{ url('audio-call') }}">Audio Call</a></li>
                                        <li><a class="{{ Request::is('call-history') ? 'active' : '' }}"
                                                href="{{ url('call-history') }}">Call History</a></li>
                                    </ul>
                                </li>
                                <li><a class="{{ Request::is('calendar') ? 'active' : '' }}"
                                        href="{{ url('calendar') }}">Calendar</a></li>
                                <li><a class="{{ Request::is('email') ? 'active' : '' }}"
                                        href="{{ url('email') }}">Email</a></li>
                                <li><a class="{{ Request::is('todo') ? 'active' : '' }}" href="{{ url('todo') }}">To
                                        Do</a></li>
                                <li><a class="{{ Request::is('notes') ? 'active' : '' }}"
                                        href="{{ url('notes') }}">Notes</a></li>
                                <li><a class="{{ Request::is('file-manager', 'file-archived','file-document','file-favourites','file-manager-seleted','file-recent','file-shared','file-manager-deleted') ? 'active' : '' }}"
                                        href="{{ url('file-manager') }}">File Manager</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Inventory</h6>
                    <ul>
                        <li class="{{ Request::is('product-list','product-details') ? 'active' : '' }}"><a
                                href="{{ url('product-list') }}"><i data-feather="box"></i><span>Products</span></a>
                        </li>
                        <li class="{{ Request::is('add-product','edit-product') ? 'active' : '' }}"><a
                                href="{{ url('add-product') }}"><i data-feather="plus-square"></i><span>Create
                                    Product</span></a></li>
                        <li class="{{ Request::is('expired-products') ? 'active' : '' }}"><a
                                href="{{ url('expired-products') }}"><i data-feather="codesandbox"></i><span>Expired
                                    Products</span></a></li>
                        <li class="{{ Request::is('low-stocks') ? 'active' : '' }}"><a
                                href="{{ url('low-stocks') }}"><i data-feather="trending-down"></i><span>Low
                                    Stocks</span></a></li>
                        <li class="{{ Request::is('category-list') ? 'active' : '' }}"><a
                                href="{{ url('category-list') }}"><i
                                    data-feather="codepen"></i><span>Category</span></a></li>
                        <li class="{{ Request::is('sub-categories') ? 'active' : '' }}"><a
                                href="{{ url('sub-categories') }}"><i data-feather="speaker"></i><span>Sub
                                    Category</span></a></li>
                        <li class="{{ Request::is('brand-list') ? 'active' : '' }}"><a
                                href="{{ url('brand-list') }}"><i data-feather="tag"></i><span>Brands</span></a></li>
                        <li class="{{ Request::is('units') ? 'active' : '' }}"><a href="{{ url('units') }}"><i
                                    data-feather="speaker"></i><span>Units</span></a></li>
                        <li class="{{ Request::is('varriant-attributes') ? 'active' : '' }}"><a
                                href="{{ url('varriant-attributes') }}"><i data-feather="layers"></i><span>Variant
                                    Attributes</span></a></li>
                        <li class="{{ Request::is('warranty') ? 'active' : '' }}"><a href="{{ url('warranty') }}"><i
                                    data-feather="bookmark"></i><span>Warranties</span></a>
                        </li>
                        <li class="{{ Request::is('barcode') ? 'active' : '' }}"><a href="{{ url('barcode') }}"><i
                                    data-feather="align-justify"></i><span>Print
                                    Barcode</span></a></li>
                        <li class="{{ Request::is('qrcode') ? 'active' : '' }}"><a href="{{ url('qrcode') }}"><i
                                    data-feather="maximize"></i><span>Print QR Code</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Stock</h6>
                    <ul>
                        <li class="{{ Request::is('manage-stocks') ? 'active' : '' }}"><a
                                href="{{ url('manage-stocks') }}"><i data-feather="package"></i><span>Manage
                                    Stock</span></a></li>
                        <li class="{{ Request::is('stock-adjustment') ? 'active' : '' }}"><a
                                href="{{ url('stock-adjustment') }}"><i data-feather="clipboard"></i><span>Stock
                                    Adjustment</span></a></li>
                        <li class="{{ Request::is('stock-transfer') ? 'active' : '' }}"><a
                                href="{{ url('stock-transfer') }}"><i data-feather="truck"></i><span>Stock
                                    Transfer</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Sales</h6>
                    <ul>
                        <li class="{{ Request::is('sales-list') ? 'active' : '' }}"><a
                                href="{{ url('sales-list') }}"><i
                                    data-feather="shopping-cart"></i><span>Sales</span></a></li>
                        <li class="{{ Request::is('invoice-report') ? 'active' : '' }}"><a
                                href="{{ url('invoice-report') }}"><i
                                    data-feather="file-text"></i><span>Invoices</span></a></li>
                        <li class="{{ Request::is('sales-returns') ? 'active' : '' }}"><a
                                href="{{ url('sales-returns') }}"><i data-feather="copy"></i><span>Sales
                                    Return</span></a></li>
                        <li class="{{ Request::is('quotation-list') ? 'active' : '' }}"><a
                                href="{{ url('quotation-list') }}"><i
                                    data-feather="save"></i><span>Quotation</span></a>
                        </li>
                        <li class="{{ Request::is('pos') ? 'active' : '' }}"><a href="{{ url('pos') }}"><i
                                    data-feather="hard-drive"></i><span>POS</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Promo</h6>
                    <ul>
                        <li class="{{ Request::is('coupons') ? 'active' : '' }}"><a href="{{ url('coupons') }}"><i
                                    data-feather="shopping-cart"></i><span>Coupons</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Purchases</h6>
                    <ul>
                        <li class="{{ Request::is('purchase-list') ? 'active' : '' }}"><a
                                href="{{ url('purchase-list') }}"><i
                                    data-feather="shopping-bag"></i><span>Purchases</span></a></li>
                        <li class="{{ Request::is('purchase-order-report') ? 'active' : '' }}"><a
                                href="{{ url('purchase-order-report') }}"><i
                                    data-feather="file-minus"></i><span>Purchase Order</span></a></li>
                        <li class="{{ Request::is('purchase-returns') ? 'active' : '' }}"><a
                                href="{{ url('purchase-returns') }}"><i data-feather="refresh-cw"></i><span>Purchase
                                    Return</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Finance & Accounts</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('expense-list', 'expense-category') ? 'active subdrop' : '' }}"><i
                                    data-feather="file-text"></i><span>Expenses</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ url('expense-list') }}"
                                        class="{{ Request::is('expense-list') ? 'active' : '' }}">Expenses</a></li>
                                <li><a href="{{ url('expense-category') }}"
                                        class="{{ Request::is('expense-category') ? 'active' : '' }}">Expense
                                        Category</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Peoples</h6>
                    <ul>
                        <li class="{{ Request::is('customers') ? 'active' : '' }}"><a
                                href="{{ url('customers') }}"><i data-feather="user"></i><span>Customers</span></a>
                        </li>
                        <li class="{{ Request::is('suppliers') ? 'active' : '' }}"><a
                                href="{{ url('suppliers') }}"><i data-feather="users"></i><span>Suppliers</span></a>
                        </li>
                        <li class="{{ Request::is('store-list') ? 'active' : '' }}"><a
                                href="{{ url('store-list') }}"><i data-feather="home"></i><span>Stores</span></a>
                        </li>
                        <li class="{{ Request::is('warehouse') ? 'active' : '' }}"><a
                                href="{{ url('warehouse') }}"><i
                                    data-feather="archive"></i><span>Warehouses</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">HRM</h6>
                    <ul>
                        <li class="{{ Request::is('employees-grid','employees-list','edit-employee','add-employee') ? 'active' : '' }}"><a
                                href="{{ url('employees-grid') }}"><i
                                    data-feather="user"></i><span>Employees</span></a></li>
                        <li class="{{ Request::is('department-grid','department-list') ? 'active' : '' }}"><a
                                href="{{ url('department-grid') }}"><i
                                    data-feather="users"></i><span>Departments</span></a></li>
                        <li class="{{ Request::is('designation') ? 'active' : '' }}"><a
                                href="{{ url('designation') }}"><i
                                    data-feather="git-merge"></i><span>Designation</span></a></li>
                        <li class="{{ Request::is('shift') ? 'active' : '' }}"><a href="{{ url('shift') }}"><i
                                    data-feather="shuffle"></i><span>Shifts</span></a></li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('attendance-employee', 'attendance-admin') ? 'active subdrop' : '' }}"><i
                                    data-feather="book-open"></i><span>Attendence</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ url('attendance-employee') }}"
                                        class="{{ Request::is('attendance-employee') ? 'active' : '' }}">Employee</a>
                                </li>
                                <li><a href="{{ url('attendance-admin') }}"
                                        class="{{ Request::is('attendance-admin') ? 'active' : '' }}">Admin</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('leaves-admin', 'leaves-employee', 'leave-types') ? 'active subdrop' : '' }}"><i
                                    data-feather="calendar"></i><span>Leaves</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ url('leaves-admin') }}"
                                        class="{{ Request::is('leaves-admin') ? 'active' : '' }}">Admin Leaves</a>
                                </li>
                                <li><a href="{{ url('leaves-employee') }}"
                                        class="{{ Request::is('leaves-employee') ? 'active' : '' }}">Employee
                                        Leaves</a></li>
                                <li><a href="{{ url('leave-types') }}"
                                        class="{{ Request::is('leave-types') ? 'active' : '' }}">Leave Types</a></li>
                            </ul>
                        </li>
                        <li class="{{ Request::is('holidays') ? 'active' : '' }}"><a
                                href="{{ url('holidays') }}"><i
                                    data-feather="credit-card"></i><span>Holidays</span></a>
                        </li>
                        <li class="submenu">
                            <a href="{{ url('payroll-list') }}"
                                class="{{ Request::is('payroll-list', 'payslip') ? 'active subdrop' : '' }}"><i
                                    data-feather="dollar-sign"></i><span>Payroll</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ url('payroll-list') }}"
                                        class="{{ Request::is('payroll-list') ? 'active' : '' }}">Employee Salary</a>
                                </li>
                                <li><a href="{{ url('payslip') }}"
                                        class="{{ Request::is('payslip') ? 'active' : '' }}">Payslip</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Reports</h6>
                    <ul>
                        <li class="{{ Request::is('sales-report') ? 'active' : '' }}"><a
                                href="{{ url('sales-report') }}"><i data-feather="bar-chart-2"></i><span>Sales
                                    Report</span></a></li>
                        <li class="{{ Request::is('purchase-report') ? 'active' : '' }}"><a
                                href="{{ url('purchase-report') }}"><i data-feather="pie-chart"></i><span>Purchase
                                    report</span></a></li>
                        <li class="{{ Request::is('inventory-report') ? 'active' : '' }}"><a
                                href="{{ url('inventory-report') }}"><i data-feather="inbox"></i><span>Inventory
                                    Report</span></a></li>
                        <li class="{{ Request::is('invoice-report') ? 'active' : '' }}"><a
                                href="{{ url('invoice-report') }}"><i data-feather="file"></i><span>Invoice
                                    Report</span></a></li>
                        <li class="{{ Request::is('supplier-report') ? 'active' : '' }}"><a
                                href="{{ url('supplier-report') }}"><i data-feather="user-check"></i><span>Supplier
                                    Report</span></a></li>
                        <li class="{{ Request::is('customer-report') ? 'active' : '' }}"><a
                                href="{{ url('customer-report') }}"><i data-feather="user"></i><span>Customer
                                    Report</span></a></li>
                        <li class="{{ Request::is('expense-report') ? 'active' : '' }}"><a
                                href="{{ url('expense-report') }}"><i data-feather="file"></i><span>Expense
                                    Report</span></a></li>
                        <li class="{{ Request::is('income-report') ? 'active' : '' }}"><a
                                href="{{ url('income-report') }}"><i data-feather="bar-chart"></i><span>Income
                                    Report</span></a></li>
                        <li class="{{ Request::is('tax-reports') ? 'active' : '' }}"><a
                                href="{{ url('tax-reports') }}"><i data-feather="database"></i><span>Tax
                                    Report</span></a></li>
                        <li class="{{ Request::is('profit-and-loss') ? 'active' : '' }}"><a
                                href="{{ url('profit-and-loss') }}"><i data-feather="pie-chart"></i><span>Profit &
                                    Loss</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">User Management</h6>
                    <ul>
                        <li class="{{ Request::is('users') ? 'active' : '' }}"><a href="{{ url('users') }}"><i
                                    data-feather="user-check"></i><span>Users</span></a>
                        </li>
                        <li class="{{ Request::is('roles-permissions','permissions') ? 'active' : '' }}"><a
                                href="{{ url('roles-permissions') }}"><i data-feather="shield"></i><span>Roles &
                                    Permissions</span></a></li>
                        <li class="{{ Request::is('delete-account') ? 'active' : '' }}"><a
                                href="{{ url('delete-account') }}"><i data-feather="lock"></i><span>Delete Account
                                    Request</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Pages</h6>
                    <ul>
                        <li class="{{ Request::is('profile') ? 'active' : '' }}"><a href="{{ url('profile') }}"><i
                                    data-feather="user"></i><span>Profile</span></a></li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i
                                    data-feather="shield"></i><span>Authentication</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li class="submenu submenu-two"><a href="javascript:void(0);">Login<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="{{ url('signin') }}">Cover</a></li>
                                        <li><a href="{{ url('signin-2') }}">Illustration</a></li>
                                        <li><a href="{{ url('signin-3') }}">Basic</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="javascript:void(0);">Register<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="{{ url('register') }}">Cover</a></li>
                                        <li><a href="{{ url('register-2') }}">Illustration</a></li>
                                        <li><a href="{{ url('register-3') }}">Basic</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="javascript:void(0);">Forgot Password<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="{{ url('forgot-password') }}">Cover</a></li>
                                        <li><a href="{{ url('forgot-password-2') }}">Illustration</a></li>
                                        <li><a href="{{ url('forgot-password-3') }}">Basic</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="javascript:void(0);">Reset Password<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="{{ url('reset-password') }}">Cover</a></li>
                                        <li><a href="{{ url('reset-password-2') }}">Illustration</a></li>
                                        <li><a href="{{ url('reset-password-3') }}">Basic</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="javascript:void(0);">Email Verification<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="{{ url('email-verification') }}">Cover</a></li>
                                        <li><a href="{{ url('email-verification-2') }}">Illustration</a></li>
                                        <li><a href="{{ url('email-verification-3') }}">Basic</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="javascript:void(0);">2 Step Verification<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="{{ url('two-step-verification') }}">Cover</a></li>
                                        <li><a href="{{ url('two-step-verification-2') }}">Illustration</a></li>
                                        <li><a href="{{ url('two-step-verification-3') }}">Basic</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ url('lock-screen') }}">Lock Screen</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="file-minus"></i><span>Error
                                    Pages</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ url('error-404') }}">404 Error </a></li>
                                <li><a href="{{ url('error-500') }}">500 Error </a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('countries', 'states') ? 'active subdrop' : '' }}"><i
                                    data-feather="map"></i><span>Places</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ url('countries') }}"
                                        class="{{ Request::is('countries') ? 'active' : '' }}">Countries</a></li>
                                <li><a href="{{ url('states') }}"
                                        class="{{ Request::is('states') ? 'active' : '' }}">States</a></li>
                            </ul>
                        </li>
                        <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                            <a href="{{ url('blank-page') }}"><i data-feather="file"></i><span>Blank Page</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('coming-soon') ? 'active' : '' }}">
                            <a href="{{ url('coming-soon') }}"><i data-feather="send"></i><span>Coming Soon</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('under-maintenance') ? 'active' : '' }}">
                            <a href="{{ url('under-maintenance') }}"><i
                                    data-feather="alert-triangle"></i><span>Under
                                    Maintenance</span> </a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Settings</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('general-settings', 'security-settings', 'notification', 'connected-apps') ? 'active subdrop' : '' }}"><i
                                    data-feather="settings"></i><span>General
                                    Settings</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ url('general-settings') }}"
                                        class="{{ Request::is('general-settings') ? 'active' : '' }}">Profile</a>
                                </li>
                                <li><a href="{{ url('security-settings') }}"
                                        class="{{ Request::is('security-settings') ? 'active' : '' }}">Security</a>
                                </li>
                                <li><a href="{{ url('notification') }}"
                                        class="{{ Request::is('notification') ? 'active' : '' }}">Notifications</a>
                                </li>
                                <li><a href="{{ url('connected-apps') }}"
                                        class="{{ Request::is('connected-apps') ? 'active' : '' }}">Connected
                                        Apps</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('system-settings', 'company-settings', 'localization-settings', 'prefixes', 'preference', 'appearance', 'social-authentication', 'language-settings','language-settings-web') ? 'active subdrop' : '' }}"><i
                                    data-feather="globe"></i><span>Website
                                    Settings</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ url('system-settings') }}"
                                        class="{{ Request::is('system-settings') ? 'active' : '' }}">System
                                        Settings</a></li>
                                <li><a href="{{ url('company-settings') }}"
                                        class="{{ Request::is('company-settings') ? 'active' : '' }}">Company
                                        Settings </a></li>
                                <li><a href="{{ url('localization-settings') }}"
                                        class="{{ Request::is('localization-settings') ? 'active' : '' }}">Localization</a>
                                </li>
                                <li><a href="{{ url('prefixes') }}"
                                        class="{{ Request::is('prefixes') ? 'active' : '' }}">Prefixes</a></li>
                                <li><a href="{{ url('preference') }}"
                                        class="{{ Request::is('preference') ? 'active' : '' }}">Preference</a></li>
                                <li><a href="{{ url('appearance') }}"
                                        class="{{ Request::is('appearance') ? 'active' : '' }}">Appearance</a></li>
                                <li><a href="{{ url('social-authentication') }}"
                                        class="{{ Request::is('social-authentication') ? 'active' : '' }}">Social
                                        Authentication</a></li>
                                <li><a href="{{ url('language-settings') }}"
                                        class="{{ Request::is('language-settings','language-settings-web') ? 'active' : '' }}">Language</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('invoice-settings', 'printer-settings', 'pos-settings', 'custom-fields') ? 'active subdrop' : '' }}"><i
                                    data-feather="smartphone"></i>
                                <span>App Settings</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ url('invoice-settings') }}"
                                        class="{{ Request::is('invoice-settings') ? 'active' : '' }}">Invoice</a>
                                </li>
                                <li><a href="{{ url('printer-settings') }}"
                                        class="{{ Request::is('printer-settings') ? 'active' : '' }}">Printer</a>
                                </li>
                                <li><a href="{{ url('pos-settings') }}"
                                        class="{{ Request::is('pos-settings') ? 'active' : '' }}">POS</a></li>
                                <li><a href="{{ url('custom-fields') }}"
                                        class="{{ Request::is('custom-fields') ? 'active' : '' }}">Custom Fields</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('email-settings', 'sms-gateway', 'otp-settings', 'gdpr-settings') ? 'active subdrop' : '' }}"><i
                                    data-feather="monitor"></i>
                                <span>System Settings</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ url('email-settings') }}"
                                        class="{{ Request::is('email-settings') ? 'active' : '' }}">Email</a></li>
                                <li><a href="{{ url('sms-gateway') }}"
                                        class="{{ Request::is('sms-gateway') ? 'active' : '' }}">SMS Gateways</a>
                                </li>
                                <li><a href="{{ url('otp-settings') }}"
                                        class="{{ Request::is('otp-settings') ? 'active' : '' }}">OTP</a></li>
                                <li><a href="{{ url('gdpr-settings') }}"
                                        class="{{ Request::is('gdpr-settings') ? 'active' : '' }}">GDPR Cookies</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('payment-gateway-settings', 'bank-settings-grid', 'bank-settings-list','tax-rates', 'currency-settings') ? 'active subdrop' : '' }}"><i
                                    data-feather="dollar-sign"></i>
                                <span>Settings</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ url('payment-gateway-settings') }}"
                                        class="{{ Request::is('payment-gateway-settings') ? 'active' : '' }}">Payment
                                        Gateway</a></li>
                                <li><a href="{{ url('bank-settings-grid') }}"
                                        class="{{ Request::is('bank-settings-grid','bank-settings-list') ? 'active' : '' }}">Bank
                                        Accounts</a></li>
                                <li><a href="{{ url('tax-rates') }}"
                                        class="{{ Request::is('tax-rates') ? 'active' : '' }}">Tax Rates</a></li>
                                <li><a href="{{ url('currency-settings') }}"
                                        class="{{ Request::is('currency-settings') ? 'active' : '' }}">Currencies</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('storage-settings', 'ban-ip-address') ? 'active subdrop' : '' }} "><i
                                    data-feather="hexagon"></i>
                                <span>Other Settings</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ url('storage-settings') }}"
                                        class="{{ Request::is('storage-settings') ? 'active' : '' }}">Storage</a>
                                </li>
                                <li><a href="{{ url('ban-ip-address') }}"
                                        class="{{ Request::is('ban-ip-address') ? 'active' : '' }}">Ban IP
                                        Address</a></li>
                            </ul>
                        </li>
                        <li class="{{ Request::is('signin') ? 'active' : '' }}">
                            <a href="{{ url('signin') }}"><i data-feather="log-out"></i><span>Logout</span> </a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">UI Interface</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('ui-alerts', 'ui-accordion', 'ui-avatar', 'ui-badges', 'ui-borders', 'ui-buttons', 'ui-buttons-group', 'ui-breadcrumb', 'ui-cards', 'ui-carousel', 'ui-colors', 'ui-dropdowns', 'ui-grid', 'ui-images', 'ui-lightbox', 'ui-modals', 'ui-media', 'ui-offcanvas', 'ui-pagination', 'ui-popovers', 'ui-progress', 'ui-placeholders', 'ui-rangeslider', 'ui-spinner', 'ui-sweetalerts', 'ui-nav-tabs', 'ui-toasts', 'ui-tooltips', 'ui-typography', 'ui-video') ? 'active subdrop' : '' }}">
                                <i data-feather="layers"></i><span>Base UI</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ url('ui-alerts') }}"
                                        class="{{ Request::is('ui-alerts') ? 'active' : '' }}">Alerts</a></li>
                                <li><a href="{{ url('ui-accordion') }}"
                                        class="{{ Request::is('ui-accordion') ? 'active' : '' }}">Accordion</a></li>
                                <li><a href="{{ url('ui-avatar') }}"
                                        class="{{ Request::is('ui-avatar') ? 'active' : '' }}">Avatar</a></li>
                                <li><a href="{{ url('ui-badges') }}"
                                        class="{{ Request::is('ui-badges') ? 'active' : '' }}">Badges</a></li>
                                <li><a href="{{ url('ui-borders') }}"
                                        class="{{ Request::is('ui-borders') ? 'active' : '' }}">Border</a></li>
                                <li><a href="{{ url('ui-buttons') }}"
                                        class="{{ Request::is('ui-buttons') ? 'active' : '' }}">Buttons</a></li>
                                <li><a href="{{ url('ui-buttons-group') }}"
                                        class="{{ Request::is('ui-buttons-group') ? 'active' : '' }}">Button
                                        Group</a></li>
                                <li><a href="{{ url('ui-breadcrumb') }}"
                                        class="{{ Request::is('ui-breadcrumb') ? 'active' : '' }}">Breadcrumb</a>
                                </li>
                                <li><a href="{{ url('ui-cards') }}"
                                        class="{{ Request::is('ui-cards') ? 'active' : '' }}">Card</a></li>
                                <li><a href="{{ url('ui-carousel') }}"
                                        class="{{ Request::is('ui-carousel') ? 'active' : '' }}">Carousel</a></li>
                                <li><a href="{{ url('ui-colors') }}"
                                        class="{{ Request::is('ui-colors') ? 'active' : '' }}">Colors</a></li>
                                <li><a href="{{ url('ui-dropdowns') }}"
                                        class="{{ Request::is('ui-dropdowns') ? 'active' : '' }}">Dropdowns</a></li>
                                <li><a href="{{ url('ui-grid') }}"
                                        class="{{ Request::is('ui-grid') ? 'active' : '' }}">Grid</a></li>
                                <li><a href="{{ url('ui-images') }}"
                                        class="{{ Request::is('ui-images') ? 'active' : '' }}">Images</a></li>
                                <li><a href="{{ url('ui-lightbox') }}"
                                        class="{{ Request::is('ui-lightbox') ? 'active' : '' }}">Lightbox</a></li>
                                <li><a href="{{ url('ui-media') }}"
                                        class="{{ Request::is('ui-media') ? 'active' : '' }}">Media</a></li>
                                <li><a href="{{ url('ui-modals') }}"
                                        class="{{ Request::is('ui-modals') ? 'active' : '' }}">Modals</a></li>
                                <li><a href="{{ url('ui-offcanvas') }}"
                                        class="{{ Request::is('ui-offcanvas') ? 'active' : '' }}">Offcanvas</a></li>
                                <li><a href="{{ url('ui-pagination') }}"
                                        class="{{ Request::is('ui-pagination') ? 'active' : '' }}">Pagination</a>
                                </li>
                                <li><a href="{{ url('ui-popovers') }}"
                                        class="{{ Request::is('ui-popovers') ? 'active' : '' }}">Popovers</a></li>
                                <li><a href="{{ url('ui-progress') }}"
                                        class="{{ Request::is('ui-progress') ? 'active' : '' }}">Progress</a></li>
                                <li><a href="{{ url('ui-placeholders') }}"
                                        class="{{ Request::is('ui-placeholders') ? 'active' : '' }}">Placeholders</a>
                                </li>
                                <li><a href="{{ url('ui-rangeslider') }}"
                                        class="{{ Request::is('ui-rangeslider') ? 'active' : '' }}">Range Slider</a>
                                </li>
                                <li><a href="{{ url('ui-spinner') }}"
                                        class="{{ Request::is('ui-spinner') ? 'active' : '' }}">Spinner</a></li>
                                <li><a href="{{ url('ui-sweetalerts') }}"
                                        class="{{ Request::is('ui-sweetalerts') ? 'active' : '' }}">Sweet Alerts</a>
                                </li>
                                <li><a href="{{ url('ui-nav-tabs') }}"
                                        class="{{ Request::is('ui-nav-tabs') ? 'active' : '' }}">Tabs</a></li>
                                <li><a href="{{ url('ui-toasts') }}"
                                        class="{{ Request::is('ui-toasts') ? 'active' : '' }}">Toasts</a></li>
                                <li><a href="{{ url('ui-tooltips') }}"
                                        class="{{ Request::is('ui-tooltips') ? 'active' : '' }}">Tooltips</a></li>
                                <li><a href="{{ url('ui-typography') }}"
                                        class="{{ Request::is('ui-typography') ? 'active' : '' }}">Typography</a>
                                </li>
                                <li><a href="{{ url('ui-video') }}"
                                        class="{{ Request::is('ui-video') ? 'active' : '' }}">Video</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('ui-ribbon', 'ui-clipboard', 'ui-drag-drop', 'ui-rating', 'ui-text-editor', 'ui-counter', 'ui-scrollbar', 'ui-stickynote', 'ui-timeline') ? 'active subdrop' : '' }}">
                                <i data-feather="layers"></i><span>Advanced UI</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ url('ui-ribbon') }}"
                                        class="{{ Request::is('ui-ribbon') ? 'active' : '' }}">Ribbon</a></li>
                                <li><a href="{{ url('ui-clipboard') }}"
                                        class="{{ Request::is('ui-clipboard') ? 'active' : '' }}">Clipboard</a></li>
                                <li><a href="{{ url('ui-drag-drop') }}"
                                        class="{{ Request::is('ui-drag-drop') ? 'active' : '' }}">Drag & Drop</a>
                                </li>
                                <li><a href="{{ url('ui-rating') }}"
                                        class="{{ Request::is('ui-rating') ? 'active' : '' }}">Rating</a></li>
                                <li><a href="{{ url('ui-text-editor') }}"
                                        class="{{ Request::is('ui-text-editor') ? 'active' : '' }}">Text Editor</a>
                                </li>
                                <li><a href="{{ url('ui-counter') }}"
                                        class="{{ Request::is('ui-counter') ? 'active' : '' }}">Counter</a></li>
                                <li><a href="{{ url('ui-scrollbar') }}"
                                        class="{{ Request::is('ui-scrollbar') ? 'active' : '' }}">Scrollbar</a></li>
                                <li><a href="{{ url('ui-stickynote') }}"
                                        class="{{ Request::is('ui-stickynote') ? 'active' : '' }}">Sticky Note</a>
                                </li>
                                <li><a href="{{ url('ui-timeline') }}"
                                        class="{{ Request::is('ui-timeline') ? 'active' : '' }}">Timeline</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('chart-apex', 'chart-c3', 'chart-js', 'chart-morris', 'chart-flot', 'chart-peity') ? 'active subdrop' : '' }}"><i
                                    data-feather="bar-chart-2"></i>
                                <span>Charts</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ url('chart-apex') }}"
                                        class="{{ Request::is('chart-apex') ? 'active' : '' }}">Apex Charts</a></li>
                                <li><a href="{{ url('chart-c3') }}"
                                        class="{{ Request::is('chart-c3') ? 'active' : '' }}">Chart C3</a></li>
                                <li><a href="{{ url('chart-js') }}"
                                        class="{{ Request::is('chart-js') ? 'active' : '' }}">Chart Js</a></li>
                                <li><a href="{{ url('chart-morris') }}"
                                        class="{{ Request::is('chart-morris') ? 'active' : '' }}">Morris Charts</a>
                                </li>
                                <li><a href="{{ url('chart-flot') }}"
                                        class="{{ Request::is('chart-flot') ? 'active' : '' }}">Flot Charts</a></li>
                                <li><a href="{{ url('chart-peity') }}"
                                        class="{{ Request::is('chart-peity') ? 'active' : '' }}">Peity Charts</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('icon-fontawesome', 'icon-feather', 'icon-ionic', 'icon-material', 'icon-pe7', 'icon-simpleline', 'icon-themify', 'icon-weather', 'icon-typicon', 'icon-flag') ? 'active subdrop' : '' }}"><i
                                    data-feather="database"></i>
                                <span>Icons</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ url('icon-fontawesome') }}"
                                        class="{{ Request::is('icon-fontawesome') ? 'active' : '' }}">Fontawesome
                                        Icons</a></li>
                                <li><a href="{{ url('icon-feather') }}"
                                        class="{{ Request::is('icon-feather') ? 'active' : '' }}">Feather Icons</a>
                                </li>
                                <li><a href="{{ url('icon-ionic') }}"
                                        class="{{ Request::is('icon-ionic') ? 'active' : '' }}">Ionic Icons</a></li>
                                <li><a href="{{ url('icon-material') }}"
                                        class="{{ Request::is('icon-material') ? 'active' : '' }}">Material Icons</a>
                                </li>
                                <li><a href="{{ url('icon-pe7') }}"
                                        class="{{ Request::is('icon-pe7') ? 'active' : '' }}">Pe7 Icons</a></li>
                                <li><a href="{{ url('icon-simpleline') }}"
                                        class="{{ Request::is('icon-simpleline') ? 'active' : '' }}">Simpleline
                                        Icons</a></li>
                                <li><a href="{{ url('icon-themify') }}"
                                        class="{{ Request::is('icon-themify') ? 'active' : '' }}">Themify Icons</a>
                                </li>
                                <li><a href="{{ url('icon-weather') }}"
                                        class="{{ Request::is('icon-weather') ? 'active' : '' }}">Weather Icons</a>
                                </li>
                                <li><a href="{{ url('icon-typicon') }}"
                                        class="{{ Request::is('icon-typicon') ? 'active' : '' }}">Typicon Icons</a>
                                </li>
                                <li><a href="{{ url('icon-flag') }}"
                                        class="{{ Request::is('icon-flag') ? 'active' : '' }}">Flag Icons</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('form-wizard', 'form-select2', 'form-validation', 'form-floating-labels', 'form-vertical', 'form-horizontal', 'form-basic-inputs', 'form-checkbox-radios', 'form-input-groups', 'form-grid-gutters', 'form-select', 'form-mask', 'form-fileupload') ? 'active subdrop' : '' }}">
                                <i data-feather="edit"></i><span>Forms</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);"
                                        class="{{ Request::is('form-basic-inputs', 'form-checkbox-radios', 'form-input-groups', 'form-grid-gutters', 'form-select', 'form-mask', 'form-fileupload') ? 'active subdrop' : '' }}">Form
                                        Elements<span class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="{{ url('form-basic-inputs') }}"
                                                class="{{ Request::is('form-basic-inputs') ? 'active' : '' }}">Basic
                                                Inputs</a></li>
                                        <li><a href="{{ url('form-checkbox-radios') }}"
                                                class="{{ Request::is('form-checkbox-radios') ? 'active' : '' }}">Checkbox
                                                & Radios</a></li>
                                        <li><a href="{{ url('form-input-groups') }}"
                                                class="{{ Request::is('form-input-groups') ? 'active' : '' }}">Input
                                                Groups</a></li>
                                        <li><a href="{{ url('form-grid-gutters') }}"
                                                class="{{ Request::is('form-grid-gutters') ? 'active' : '' }}">Grid &
                                                Gutters</a></li>
                                        <li><a href="{{ url('form-select') }}"
                                                class="{{ Request::is('form-select') ? 'active' : '' }}">Form
                                                Select</a></li>
                                        <li><a href="{{ url('form-mask') }}"
                                                class="{{ Request::is('form-mask') ? 'active' : '' }}">Input
                                                Masks</a></li>
                                        <li><a href="{{ url('form-fileupload') }}"
                                                class="{{ Request::is('form-fileupload') ? 'active' : '' }}">File
                                                Uploads</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);"
                                        class="{{ Request::is('form-horizontal', 'form-vertical', 'form-floating-labels') ? 'active subdrop' : '' }}">Layouts<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="{{ url('form-horizontal') }}"
                                                class="{{ Request::is('form-horizontal') ? 'active' : '' }}">Horizontal
                                                Form</a></li>
                                        <li><a href="{{ url('form-vertical') }}"
                                                class="{{ Request::is('form-vertical') ? 'active' : '' }}">Vertical
                                                Form</a></li>
                                        <li><a href="{{ url('form-floating-labels') }}"
                                                class="{{ Request::is('form-floating-labels') ? 'active' : '' }}">Floating
                                                Labels</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ url('form-validation') }}"
                                        class="{{ Request::is('form-validation') ? 'active' : '' }}">Form
                                        Validation</a></li>
                                <li><a href="{{ url('form-select2') }}"
                                        class="{{ Request::is('form-select2') ? 'active' : '' }}">Select2</a></li>
                                <li><a href="{{ url('form-wizard') }}"
                                        class="{{ Request::is('form-wizard') ? 'active' : '' }}">Form Wizard</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('tables-basic', 'data-tables') ? 'active subdrop' : '' }}"><i
                                    data-feather="columns"></i><span>Tables</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ url('tables-basic') }}"
                                        class="{{ Request::is('tables-basic') ? 'active' : '' }}">Basic Tables </a>
                                </li>
                                <li><a href="{{ url('data-tables') }}"
                                        class="{{ Request::is('data-tables') ? 'active' : '' }}">Data Table </a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Help</h6>
                    <ul>
                        <li><a href="javascript:void(0);"><i
                                    data-feather="file-text"></i><span>Documentation</span></a></li>
                        <li><a href="javascript:void(0);"><i data-feather="lock"></i><span>Changelog v2.0.7</span></a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="file-minus"></i><span>Multi
                                    Level</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="javascript:void(0);">Level 1.1</a></li>
                                <li class="submenu submenu-two"><a href="javascript:void(0);">Level 1.2<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Level 2.1</a></li>
                                        <li class="submenu submenu-two submenu-three"><a
                                                href="javascript:void(0);">Level 2.2<span
                                                    class="menu-arrow inside-submenu inside-submenu-two"></span></a>
                                            <ul>
                                                <li><a href="javascript:void(0);">Level 3.1</a></li>
                                                <li><a href="javascript:void(0);">Level 3.2</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
