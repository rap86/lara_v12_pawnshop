<!doctype html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>AdminLTE | Dashboard v2</title>
		<!--begin::Theme Init (prevents flash of incorrect theme on load, #6043)-->
		<style>
            /* 1. Automatically recalculates and layers cascading stacked backdrops correctly */
            .modal-backdrop.show:nth-of-type(even) {
                z-index: 1061 !important;
            }

            /* 2. Forces all global confirmation modals to float cleanly on top of existing modal states */
            #confirmationModalAdd,
            #confirmationModalUpdate,
            #confirmationModalDelete {
                z-index: 1065 !important;
            }
        </style>
        <script>
			(() => {
				'use strict';
				const STORAGE_KEY = 'lte-theme';
				let stored = null;
				try {
					stored = localStorage.getItem(STORAGE_KEY);
				} catch {
					// localStorage may be unavailable (private mode, sandboxed iframe).
				}
				const prefersDark = globalThis.matchMedia('(prefers-color-scheme: dark)').matches;
				// Mirror the resolution in _scripts.astro: explicit "dark"/"light" win,
				// otherwise ("auto" or unset) fall back to the OS preference.
				let resolved = 'light';
				if (stored === 'dark' || stored === 'light') {
					resolved = stored;
				} else if (prefersDark) {
					resolved = 'dark';
				}
				document.documentElement.setAttribute('data-bs-theme', resolved);
				document.documentElement.style.colorScheme = resolved;
			})();
		</script>
		<!--end::Theme Init-->

		<!--begin::Accessibility Meta Tags-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
		<meta name="color-scheme" content="light dark" />
		<meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
		<meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
		<!--end::Accessibility Meta Tags-->

		<!--begin::Primary Meta Tags-->
		<meta name="title" content="AdminLTE | Dashboard v2" />
		<meta name="author" content="ColorlibHQ" />
		<meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
		<meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />
		<!--end::Primary Meta Tags-->

		<!--begin::Accessibility Features-->
		<!-- Skip links will be dynamically added by accessibility.js -->
		<meta name="supported-color-schemes" content="light dark" />
		<link rel="preload" href="{{ asset('adminlte/css/adminlte.css') }}" as="style" />
		<!--end::Accessibility Features-->

		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print" onload="this.media = 'all'"/>
		<!--end::Fonts-->

		<!--begin::Third Party Plugin(OverlayScrollbars)-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
		<!--end::Third Party Plugin(OverlayScrollbars)-->

		<!--begin::Third Party Plugin(Bootstrap Icons)-->
		<link rel="stylesheet" href="{{ asset('adminlte/css/bootstrap-icons.min.css') }}">
		<!--end::Third Party Plugin(Bootstrap Icons)-->

		<!--begin::Required Plugin(AdminLTE)-->
		<link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">
		<!--end::Required Plugin(AdminLTE)-->

		<!-- apexcharts -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
	</head>
	<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
		<!--begin::App Wrapper-->
		<div class="app-wrapper">
			<!--begin::Header-->
			<nav class="app-header navbar navbar-expand bg-body">
				<!--begin::Container-->
				<div class="container-fluid">
					<!--begin::Start Navbar Links-->
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
								<i class="bi bi-list"></i>
							</a>
						</li>
						<li class="nav-item d-none d-md-block">
							<a href="{{ route('database.download') }}" class="btn btn-secondary shadow-sm nav-link border" alt="Download db">
                                <span class="d-inline-block position-relative">
                                    <i class="bi bi-download"></i>
                                    <i class="bi bi-database-down"></i> Backup DB
                                </span>
                            </a>
						</li>
						<li class="nav-item d-none d-md-block">
							<a href="{{ route('dashboards.index') }}" class="btn btn-secondary shadow-sm nav-link border" alt="Dashboard">
                                <span class="d-inline-block position-relative">
                                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                                </span>
                            </a>
						</li>
					</ul>
					<!--end::Start Navbar Links-->
					<!--begin::End Navbar Links-->
					<ul class="navbar-nav ms-auto">
						<!--begin::Navbar Search-->
						<li class="nav-item">
							<a class="nav-link" data-widget="navbar-search" href="#" role="button">
								<i class="bi bi-search"></i>
							</a>
						</li>
						<!--end::Navbar Search-->
						<!--begin::Messages Dropdown Menu-->
						<li class="nav-item dropdown">
                            <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                <i class="bi bi-chat-left-text"></i>
                                <span class="badge text-bg-danger navbar-badge d-none" id="nav-msg-badge-count">0</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" style="min-width: 320px;">
                                <span class="dropdown-item dropdown-header text-start fw-bold border-bottom" id="nav-msg-header-text">
                                    No New Messages
                                </span>

                                <div id="nav-notifications-box-target">
                                    <div class="p-3 text-center text-muted small">Loading updates...</div>
                                </div>

                                <a href="{{ route('chat.index') }}" class="dropdown-item dropdown-footer text-center small text-muted py-2 border-top">
                                    See All Messages
                                </a>
                            </div>
                        </li>
						<!--end::Messages Dropdown Menu-->
						<!--begin::Notifications Dropdown Menu-->
						<li class="nav-item dropdown">
							<a class="nav-link" data-bs-toggle="dropdown" href="#">
								<i class="bi bi-bell-fill"></i>
								<span class="navbar-badge badge text-bg-warning">15</span>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
								<span class="dropdown-item dropdown-header">15 Notifications</span>
								<div class="dropdown-divider"></div>
								<a href="#" class="dropdown-item">
									<i class="bi bi-envelope me-2"></i> 4 new messages <span class="float-end text-secondary fs-7">3 mins</span>
								</a>
								<div class="dropdown-divider"></div>
								<a href="#" class="dropdown-item">
									<i class="bi bi-people-fill me-2"></i> 8 friend requests <span class="float-end text-secondary fs-7">12 hours</span>
								</a>
								<div class="dropdown-divider"></div>
								<a href="#" class="dropdown-item">
									<i class="bi bi-file-earmark-fill me-2"></i> 3 new reports <span class="float-end text-secondary fs-7">2 days</span>
								</a>
								<div class="dropdown-divider"></div>
								<a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
							</div>
						</li>
						<!--end::Notifications Dropdown Menu-->
						<!--begin::Fullscreen Toggle-->
						<li class="nav-item">
							<a class="nav-link" href="#" data-lte-toggle="fullscreen">
								<i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
								<i data-lte-icon="minimize" class="bi bi-fullscreen-exit d-none"></i>
							</a>
						</li>
						<!--end::Fullscreen Toggle-->
						<!--begin::Color Mode Toggle (#6010)-->
						<li class="nav-item dropdown">
							<a class="nav-link" href="#" id="bd-theme" aria-label="Toggle color scheme" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="bi bi-sun-fill" data-lte-theme-icon="light"></i>
								<i class="bi bi-moon-fill d-none" data-lte-theme-icon="dark"></i>
								<i class="bi bi-circle-half d-none" data-lte-theme-icon="auto"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme" style="--bs-dropdown-min-width: 8rem">
								<li>
									<button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
										<i class="bi bi-sun-fill me-2"></i> Light <i class="bi bi-check-lg ms-auto d-none"></i>
									</button>
								</li>
								<li>
									<button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
										<i class="bi bi-moon-fill me-2"></i> Dark <i class="bi bi-check-lg ms-auto d-none"></i>
									</button>
								</li>
								<li>
									<button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
										<i class="bi bi-circle-half me-2"></i> Auto <i class="bi bi-check-lg ms-auto d-none"></i>
									</button>
								</li>
							</ul>
						</li>
						<!--end::Color Mode Toggle-->
						<!--begin::User Menu Dropdown-->
						<li class="nav-item dropdown user-menu">
							<a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
								<img src="{{ asset('adminlte/assets/img/user2-160x160.jpg') }}" class="user-image rounded-circle shadow" alt="User Image" />
								@auth
                                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                                @endauth

                                @guest
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary">Log In</a>
                                @endguest
							</a>
							<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
								<!--begin::User Image-->
								<li class="user-header text-bg-primary">
									<img src="{{ asset('adminlte/assets/img/user2-160x160.jpg') }}" class="rounded-circle shadow" alt="User Image" />
									<p> Alexander Pierce - Web Developer <small>Member since Nov. 2023</small>
									</p>
								</li>
								<!--end::User Image-->
								<!--begin::Menu Body-->
								<li class="user-body">
									<!--begin::Row-->
									<div class="row">
										<div class="col-4 text-center">
											<a href="#">Followers</a>
										</div>
										<div class="col-4 text-center">
											<a href="#">Sales</a>
										</div>
										<div class="col-4 text-center">
											<a href="#">Friends</a>
										</div>
									</div>
									<!--end::Row-->
								</li>
								<!--end::Menu Body-->
								<!--begin::Menu Footer-->
								<li class="user-footer">
									<a href="{{ route('users.show', Auth::user()->id) }}" class="btn btn-outline-secondary">Profile</a>
									<form method="POST" action="{{ route('logout') }}" class=" float-end">
                                        @csrf

                                        <a class="btn btn-outline-danger" href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Sign out') }}
                                        </a>
                                    </form>
								</li>
								<!--end::Menu Footer-->
							</ul>
						</li>
						<!--end::User Menu Dropdown-->
					</ul>
					<!--end::End Navbar Links-->
				</div>
				<!--end::Container-->
			</nav>
			<!--end::Header-->
			<!--begin::Sidebar-->
			<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
				<!--begin::Sidebar Brand-->
				<div class="sidebar-brand">
					<!--begin::Brand Link-->
					<a href="{{ route('hereafterlogin') }}" class="brand-link">
						<!--begin::Brand Image-->
						<img src="{{ asset('adminlte/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
						<!--end::Brand Image-->
						<!--begin::Brand Text-->
						<span class="brand-text fw-light">AdminLTE 4</span>
						<!--end::Brand Text-->
					</a>
					<!--end::Brand Link-->
				</div>
				<!--end::Sidebar Brand-->
				<!--begin::Sidebar Wrapper-->
				<div class="sidebar-wrapper">
					<nav class="mt-2" aria-label="Main navigation">

						<div class="px-3 py-2">
                            <form id="branch-switch-form" action="{{ route('branch.switch') }}" method="POST">
                                @csrf

                                @php
                                    $user = auth()->user();
                                    $isClerk = ($user->role === 'clerk');

                                    // Core Logic: Clerks get forced to their home branch ID, Admins fallback to session null
                                    $currentSelection = $isClerk ? $user->branch_id : session('active_branch_id', null);
                                @endphp

                                <!-- Strictly locked dropdown styling applied if clerk role checks out -->
                                <select name="branch_id"
                                        class="form-select bg-dark text-white border-secondary"
                                        @if($isClerk) disabled style="opacity: 0.65; cursor: not-allowed;" @else onchange="document.getElementById('branch-switch-form').submit();" @endif>

                                    <!-- Global Admin Option -->
                                    @if($user->role === 'admin')
                                        <option value="" {{ is_null($currentSelection) ? 'selected' : '' }}>All Branches (Global)</option>
                                    @endif

                                    <!-- Individual Branches Loop -->
                                    @foreach($sidebarBranches as $branch)
                                        <option value="{{ $branch->id }}" {{ (!is_null($currentSelection) && $currentSelection == $branch->id) ? 'selected' : '' }}>
                                            {{ $branch->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- Crucial HTML Guardrail: Disabled select components do not submit in POST forms.
                                    This hidden field handles underlying payload safety. -->
                                @if($isClerk)
                                    <input type="hidden" name="branch_id" value="{{ $user->branch_id }}">
                                @endif
                            </form>
                        </div>

						<!--begin::Sidebar Menu-->
						<ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" data-accordion="false" id="navigation">
							<li class="nav-item">
								<a href="{{ route('customers.index') }}" class="nav-link">
									<i class="nav-icon bi bi-people"></i>
									<p>Customers</p>
								</a>
							</li>
                            <li class="nav-item">
								<a href="{{ route('chat.index') }}" class="nav-link">
									<i class="nav-icon bi bi-people"></i>
									<p>Chat</p>
								</a>
							</li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-box-seam-fill"></i>
                                    <p> Admin <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('users.index') }}" class="nav-link">
                                            <i class="nav-icon bi bi-people"></i>
                                            <p>Users</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('branches.index') }}" class="nav-link">
                                            <i class="nav-icon bi bi-house"></i>
                                            <p>Branches</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('system_settings.index') }}" class="nav-link">
                                            <i class="nav-icon bi bi-gear"></i>
                                            <p>Settings</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
							<li class="nav-item menu-open">
								<a href="#" class="nav-link active">
									<i class="nav-icon bi bi-speedometer"></i>
									<p> Dashboard <i class="nav-arrow bi bi-chevron-right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="./index.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Dashboard v1</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./index2.html" class="nav-link active">
											<i class="nav-icon bi bi-circle"></i>
											<p>Dashboard v2</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./index3.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Dashboard v3</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item">
								<a href="./generate/theme.html" class="nav-link">
									<i class="nav-icon bi bi-palette"></i>
									<p>Theme Generate</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-box-seam-fill"></i>
									<p> Widgets <i class="nav-arrow bi bi-chevron-right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="./widgets/small-box.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Small Box</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./widgets/info-box.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>info Box</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-clipboard-fill"></i>
									<p> Layout Options <span class="nav-badge badge text-bg-secondary me-3">7</span>
										<i class="nav-arrow bi bi-chevron-right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="./layout/unfixed-sidebar.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Default Sidebar</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./layout/fixed-sidebar.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Fixed Sidebar</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./layout/fixed-header.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Fixed Header</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./layout/fixed-footer.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Fixed Footer</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./layout/fixed-complete.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Fixed Complete</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./layout/layout-custom-area.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Layout <small>+ Custom Area </small>
											</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./layout/sidebar-mini.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Sidebar Mini</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./layout/collapsed-sidebar.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Sidebar Mini <small>+ Collapsed</small>
											</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./layout/collapsed-sidebar-without-hover.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Sidebar Mini <small>+ Collapsed + No Hover</small>
											</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./layout/logo-switch.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Sidebar Mini <small>+ Logo Switch</small>
											</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./layout/layout-rtl.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Layout RTL</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-tree-fill"></i>
									<p> UI Elements <i class="nav-arrow bi bi-chevron-right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="./UI/general.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>General</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./UI/icons.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Icons</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./UI/timeline.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Timeline</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-envelope"></i>
									<p> Mailbox <i class="nav-arrow bi bi-chevron-right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="./mailbox/inbox.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Inbox</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./mailbox/read.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Read Message</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./mailbox/compose.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Compose</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-pencil-square"></i>
									<p> Forms <i class="nav-arrow bi bi-chevron-right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="./forms/elements.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Elements</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./forms/layout.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Layout</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./forms/validation.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Validation</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./forms/wizard.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Wizard</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-table"></i>
									<p> Tables <i class="nav-arrow bi bi-chevron-right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="./tables/simple.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Simple Tables</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./tables/data.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Data Tables</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-header">PAGES</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-file-earmark-text"></i>
									<p> Pages <i class="nav-arrow bi bi-chevron-right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="./pages/profile.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Profile</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./pages/settings.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Settings</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./pages/invoice.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Invoice</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./pages/calendar.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Calendar</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./pages/kanban.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Kanban</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./pages/chat.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Chat</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./pages/file-manager.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>File Manager</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./pages/projects.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Projects</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./pages/pricing.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Pricing</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="./pages/faq.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>FAQ</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="#" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p> Error <i class="nav-arrow bi bi-chevron-right"></i>
											</p>
										</a>
										<ul class="nav nav-treeview">
											<li class="nav-item">
												<a href="./pages/404.html" class="nav-link">
													<i class="nav-icon bi bi-circle"></i>
													<p>404</p>
												</a>
											</li>
											<li class="nav-item">
												<a href="./pages/500.html" class="nav-link">
													<i class="nav-icon bi bi-circle"></i>
													<p>500</p>
												</a>
											</li>
											<li class="nav-item">
												<a href="./pages/maintenance.html" class="nav-link">
													<i class="nav-icon bi bi-circle"></i>
													<p>Maintenance</p>
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
							<li class="nav-header">EXAMPLES</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-box-arrow-in-right"></i>
									<p> Auth <i class="nav-arrow bi bi-chevron-right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="#" class="nav-link">
											<i class="nav-icon bi bi-box-arrow-in-right"></i>
											<p> Version 1 <i class="nav-arrow bi bi-chevron-right"></i>
											</p>
										</a>
										<ul class="nav nav-treeview">
											<li class="nav-item">
												<a href="./examples/login.html" class="nav-link">
													<i class="nav-icon bi bi-circle"></i>
													<p>Login</p>
												</a>
											</li>
											<li class="nav-item">
												<a href="./examples/register.html" class="nav-link">
													<i class="nav-icon bi bi-circle"></i>
													<p>Register</p>
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-item">
										<a href="#" class="nav-link">
											<i class="nav-icon bi bi-box-arrow-in-right"></i>
											<p> Version 2 <i class="nav-arrow bi bi-chevron-right"></i>
											</p>
										</a>
										<ul class="nav nav-treeview">
											<li class="nav-item">
												<a href="./examples/login-v2.html" class="nav-link">
													<i class="nav-icon bi bi-circle"></i>
													<p>Login</p>
												</a>
											</li>
											<li class="nav-item">
												<a href="./examples/register-v2.html" class="nav-link">
													<i class="nav-icon bi bi-circle"></i>
													<p>Register</p>
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-item">
										<a href="./examples/lockscreen.html" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Lockscreen</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-header">MULTI LEVEL EXAMPLE</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-circle-fill"></i>
									<p>Level 1</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-circle-fill"></i>
									<p> Level 1 <i class="nav-arrow bi bi-chevron-right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="#" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Level 2</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="#" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p> Level 2 <i class="nav-arrow bi bi-chevron-right"></i>
											</p>
										</a>
										<ul class="nav nav-treeview">
											<li class="nav-item">
												<a href="#" class="nav-link">
													<i class="nav-icon bi bi-record-circle-fill"></i>
													<p>Level 3</p>
												</a>
											</li>
											<li class="nav-item">
												<a href="#" class="nav-link">
													<i class="nav-icon bi bi-record-circle-fill"></i>
													<p>Level 3</p>
												</a>
											</li>
											<li class="nav-item">
												<a href="#" class="nav-link">
													<i class="nav-icon bi bi-record-circle-fill"></i>
													<p>Level 3</p>
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-item">
										<a href="#" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Level 2</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-circle-fill"></i>
									<p>Level 1</p>
								</a>
							</li>
							<li class="nav-header">LABELS</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-circle text-danger"></i>
									<p class="text">Important</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-circle text-warning"></i>
									<p>Warning</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-circle text-info"></i>
									<p>Informational</p>
								</a>
							</li>
						</ul>
						<!--end::Sidebar Menu-->
						<!-- Docs CTA (bottom of sidebar) -->
						<div class="p-3 mt-3 border-top border-secondary border-opacity-25">
							<a href="./docs/introduction.html" class="btn btn-sm btn-outline-light w-100 d-flex align-items-center justify-content-center gap-2">
								<i class="bi bi-book" aria-hidden="true"></i> View documentation </a>
						</div>
					</nav>
				</div>
				<!--end::Sidebar Wrapper-->
			</aside>
			<!--end::Sidebar-->
			<!--begin::App Main-->
			<main class="app-main">
				<!--begin::App Content Header-->
				<div class="app-content-header">

					<!--begin::Container-->
					<div class="container-fluid">
						<!--begin::Row-->
						<div class="row">
							<div class="col-sm-6">
								<form action="{{ route('customers.search') }}" method="GET" class="input-group">
									<span class="input-group-text"><i class="bi bi-search"></i></span>
									<input
										type="search"
										name="search"
										class="form-control fs-4"
										placeholder="Search by name..."
										value="{{ request('search') }}"
										onsearch="this.form.submit()"
									/>
								</form>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item">
										<a href="#">Home</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Dashboard v2</li>
								</ol>
							</div>
						</div>
						<!--end::Row-->
					</div>
					<!--end::Container-->

				</div>
				<div class="app-content">
					<!--begin::Container-->
					<div class="container-fluid">
                        <!--Here Body Start-->
						@yield('content')
					    <!--Here Body End-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::App Content-->
			</main>
			<!--end::App Main-->
			<!--begin::Footer-->
			<footer class="app-footer">
				<!--begin::To the end-->
				<div class="float-end d-none d-sm-inline">Anything you want</div>
				<!--end::To the end-->
				<!--begin::Copyright-->
				<strong> Copyright &copy; 2014-2026&nbsp; <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>. </strong> All rights reserved.
				<!--end::Copyright-->
			</footer>
			<!--end::Footer-->
		</div>
		<!--end::App Wrapper-->

		<!--begin::Script-->
		<!--begin::Third Party Plugin(OverlayScrollbars)-->
		<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
		<!--end::Third Party Plugin(OverlayScrollbars)-->

		<!--begin::Required Plugin(popperjs for Bootstrap 5)-->
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
		<!--end::Required Plugin(popperjs for Bootstrap 5)-->

		<!--begin::Required Plugin(Bootstrap 5)-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
		<!--end::Required Plugin(Bootstrap 5)-->

		<!--begin::Required Plugin(AdminLTE)-->
        <script src="{{ asset('adminlte/js/jquery.min.js') }}"></script>
        <script src="{{ asset('adminlte/js/sweetalert2.all.min.js') }}"></script>
		<script src="{{ asset('adminlte/js/adminlte.js') }}"></script>
		<!--end::Required Plugin(AdminLTE)-->


		<!--begin::OverlayScrollbars Configure-->
		<script>
			const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
			const Default = {
				scrollbarTheme: 'os-theme-light',
				scrollbarAutoHide: 'leave',
				scrollbarClickScroll: true,
			};
			document.addEventListener('DOMContentLoaded', function() {
				const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
				// Disable OverlayScrollbars on mobile devices to prevent touch interference
				const isMobile = window.innerWidth <= 992;
				if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined && !isMobile) {
					OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
						scrollbars: {
							theme: Default.scrollbarTheme,
							autoHide: Default.scrollbarAutoHide,
							clickScroll: Default.scrollbarClickScroll,
						},
					});
				}
			});
		</script>
		<!--end::OverlayScrollbars Configure-->
		<!--begin::Color Mode Toggle (#6010)-->
		<script>
			(() => {
				'use strict';
				const STORAGE_KEY = 'lte-theme';
				const getStoredTheme = () => localStorage.getItem(STORAGE_KEY);
				const setStoredTheme = (theme) => localStorage.setItem(STORAGE_KEY, theme);
				const prefersDark = () => globalThis.matchMedia('(prefers-color-scheme: dark)').matches;
				const getPreferredTheme = () => {
					const stored = getStoredTheme();
					if (stored) return stored;
					return prefersDark() ? 'dark' : 'light';
				};
				const setTheme = (theme) => {
					const resolved = theme === 'auto' ? (prefersDark() ? 'dark' : 'light') : theme;
					document.documentElement.setAttribute('data-bs-theme', resolved);
				};
				setTheme(getPreferredTheme());
				const showActiveTheme = (theme) => {
					// Highlight the active dropdown option
					document.querySelectorAll('[data-bs-theme-value]').forEach((el) => {
						el.classList.remove('active');
						el.setAttribute('aria-pressed', 'false');
						const check = el.querySelector('.bi-check-lg');
						if (check) check.classList.add('d-none');
					});
					const active = document.querySelector(`[data-bs-theme-value="${theme}"]`);
					if (active) {
						active.classList.add('active');
						active.setAttribute('aria-pressed', 'true');
						const check = active.querySelector('.bi-check-lg');
						if (check) check.classList.remove('d-none');
					}
					// Sync the topbar trigger icon
					document.querySelectorAll('[data-lte-theme-icon]').forEach((icon) => {
						icon.classList.toggle('d-none', icon.dataset.lteThemeIcon !== theme);
					});
				};
				globalThis.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
					const stored = getStoredTheme();
					if (!stored || stored === 'auto') setTheme(getPreferredTheme());
				});
				document.addEventListener('DOMContentLoaded', () => {
					showActiveTheme(getPreferredTheme());
					document.querySelectorAll('[data-bs-theme-value]').forEach((toggle) => {
						toggle.addEventListener('click', () => {
							const theme = toggle.getAttribute('data-bs-theme-value');
							setStoredTheme(theme);
							setTheme(theme);
							showActiveTheme(theme);
						});
					});
				});
			})();
		</script>
		<!--end::Color Mode Toggle-->

		<script>
            $(document).ready(function () {

                $('button.btnClickMe').click(function() {
                    Swal.fire({
                        icon: "success",
                        title: "Your work has been saved",
                        showConfirmButton: false,
                        timer: 1500
                        });
                });

                // For flash message success
                @if(Session::has('flash_success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: ' {{ Session::get('flash_success')}}',
                        showConfirmButton: false,
                        timer: 1500
                    });
                @endif

                // For flash message failure
                @if(Session::has('flash_failure'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: ' {{ Session::get('flash_failure')}}',
                        showConfirmButton: false,
                        timer: 1500
                    });
                @endif

                // This will fire, every time cancel button click.
                $('#btnCancelProcedure').click(function() {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops!',
                        text: 'You cancelled the procedure.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });

            });
        </script>
        @include('elements.bs_modal_confirmation_record_add')
        @include('elements.bs_modal_confirmation_record_update')
        @include('elements.bs_modal_confirmation_record_delete')

        <script>
            function checkGlobalChatNotifications() {
                const targetElements = document.querySelectorAll('#nav-notifications-box-target, .nav-notifications-box-target');
                const badgeElements = document.querySelectorAll('#nav-msg-badge-count, .navbar-badge');
                const headerElements = document.querySelectorAll('#nav-msg-header-text');

                if (targetElements.length === 0) return;

                fetch("/ajax-chat/notifications", {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error("HTTP error " + response.status);
                    return response.json();
                })
                .then(data => {
                    // Update all badge counters across layout frameworks
                    badgeElements.forEach(badge => {
                        if (data.count > 0) {
                            badge.textContent = data.count;
                            badge.classList.remove('d-none');
                            badge.style.setProperty('display', 'inline-block', 'important');
                        } else {
                            badge.classList.add('d-none');
                        }
                    });

                    headerElements.forEach(header => {
                        header.textContent = data.count > 0 ? `${data.count} New Messages` : "No New Messages";
                    });

                    let listHtml = '';
                    if (data.notifications && data.notifications.length > 0) {
                        data.notifications.forEach(item => {
                            // 🌟 The code template block belongs INSIDE this loop!
                            listHtml += `
                                <a href="javascript:void(0);" onclick="clearNotificationRoom(${item.conversation_id}, ${item.sender_id})" class="dropdown-item border-bottom text-decoration-none py-2 d-block text-dark">
                                    <div class="d-flex align-items-center px-2">
                                        <div class="flex-shrink-0 me-3">
                                            <span class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center font-weight-bold" style="width: 35px; height: 35px; font-size: 12px;">
                                                ${item.sender_name.substring(0, 2).toUpperCase()}
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <div class="fw-bold text-truncate small mb-0">${item.sender_name}</div>
                                            <div class="text-muted text-truncate x-small" style="font-size: 0.8rem; max-width: 200px;">${item.body}</div>
                                            <div class="text-secondary x-small mt-1" style="font-size: 0.7rem;"><i class="bi bi-clock me-1"></i>${item.time}</div>
                                        </div>
                                    </div>
                                </a>
                            `;
                        });
                    } else {
                        listHtml = `<div class="p-3 text-center text-muted small">Your tray is all caught up!</div>`;
                    }

                    targetElements.forEach(target => {
                        target.innerHTML = listHtml;
                    });
                })
                .catch(error => {
                    console.error("Pipeline Sync Error: ", error);
                });
            }

            // Start tracking across all admin pages immediately on page generation load
            document.addEventListener("DOMContentLoaded", function() {
                checkGlobalChatNotifications();
                setInterval(checkGlobalChatNotifications, 4000);
            });

            // 🌟 Action Handler: Marks messages as read before moving windows
            function clearNotificationRoom(conversationId, senderId) {
                fetch("/ajax-chat/mark-as-read", {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({ conversation_id: conversationId })
                })
                .then(() => {
                    window.location.href = `/chat?user_id=${senderId}`;
                })
                .catch(() => {
                    window.location.href = `/chat?user_id=${senderId}`;
                });
            }
            </script>

	</body>
	<!--end::Body-->
</html>
