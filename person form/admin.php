<?php
session_start();

// 1. Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// 2. Check if user is an admin
if (!isset($_SESSION['role']) && $_SESSION['role'] != "admin") {
    header("Location: userdashboard.php");
    exit();
}

// 3. Get the email for use in the page
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<!-- Rest of your HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#5D5CDE',
                        dark: '#181818'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white dark:bg-dark text-gray-900 dark:text-white transition-colors duration-300">
    <!-- Sidebar -->
    <div id="sidebar" class="fixed left-0 top-0 h-full w-64 bg-gray-50 dark:bg-gray-800 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-30">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-bold text-primary">Admin Panel</h2>
        </div>
        <nav class="mt-6">
            <a href="#" onclick="showSection('dashboard')" class="nav-item active flex items-center px-6 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="#" onclick="showSection('users')" class="nav-item flex items-center px-6 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                <i class="fas fa-users mr-3"></i>
                Users
            </a>
            <a href="#" onclick="showSection('analytics')" class="nav-item flex items-center px-6 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                <i class="fas fa-chart-bar mr-3"></i>
                Analytics
            </a>
            <a href="#" onclick="showSection('settings')" class="nav-item flex items-center px-6 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                <i class="fas fa-cog mr-3"></i>
                Settings
            </a>
        </nav>
        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
               <a href="logout.php" class="flex items-center w-full px-4 py-3 text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors duration-200">
              <i class="fas fa-sign-out-alt mr-3 text-lg"></i>Logout</a>

            </div>
    </div>

    <!-- Mobile overlay -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Header -->
        <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <button onclick="toggleSidebar()" class="lg:hidden mr-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 id="pageTitle" class="text-2xl font-semibold">Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="flex items-center space-x-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                A
                            </div>
                            <span class="hidden md:block">Admin User</span>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Section -->
        <div id="dashboardSection" class="section p-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total Users</p>
                            <p class="text-3xl font-bold text-primary">1,234</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-blue-600 dark:text-blue-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-500 font-medium">+12.5%</span>
                        <span class="text-gray-500 dark:text-gray-400 ml-2">from last month</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Active Sessions</p>
                            <p class="text-3xl font-bold text-green-600">567</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-line text-green-600 dark:text-green-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-500 font-medium">+8.2%</span>
                        <span class="text-gray-500 dark:text-gray-400 ml-2">from yesterday</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Revenue</p>
                            <p class="text-3xl font-bold text-purple-600">$12,458</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-dollar-sign text-purple-600 dark:text-purple-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-red-500 font-medium">-3.1%</span>
                        <span class="text-gray-500 dark:text-gray-400 ml-2">from last week</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Orders</p>
                            <p class="text-3xl font-bold text-orange-600">89</p>
                        </div>
                        <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-orange-600 dark:text-orange-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-500 font-medium">+15.7%</span>
                        <span class="text-gray-500 dark:text-gray-400 ml-2">from last week</span>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold mb-4">User Growth</h3>
                    <canvas id="userGrowthChart" width="400" height="200"></canvas>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold mb-4">Revenue Distribution</h3>
                    <canvas id="revenueChart" width="400" height="200"></canvas>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold">Recent Activity</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-plus text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium">New user registered</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">john.doe@example.com - 2 minutes ago</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-green-600 dark:text-green-400"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium">New order placed</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Order #1234 - $125.99 - 5 minutes ago</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium">System maintenance scheduled</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Tonight at 2:00 AM - 15 minutes ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Section -->
        <div id="usersSection" class="section hidden p-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold">User Management</h3>
                        <button onclick="showAddUserModal()" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors">
                            <i class="fas fa-plus mr-2"></i>Add User
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th class="text-left py-3 px-4">User</th>
                                    <th class="text-left py-3 px-4">Email</th>
                                    <th class="text-left py-3 px-4">Role</th>
                                    <th class="text-left py-3 px-4">Status</th>
                                    <th class="text-left py-3 px-4">Last Login</th>
                                    <th class="text-left py-3 px-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="usersTable">
                                <tr class="border-b border-gray-100 dark:border-gray-700">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white text-sm font-semibold">JD</div>
                                            <span>John Doe</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">john.doe@example.com</td>
                                    <td class="py-3 px-4">
                                        <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-2 py-1 rounded-full text-xs">Admin</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-2 py-1 rounded-full text-xs">Active</span>
                                    </td>
                                    <td class="py-3 px-4">2 hours ago</td>
                                    <td class="py-3 px-4">
                                        <button onclick="editUser('john.doe@example.com')" class="text-blue-600 hover:text-blue-800 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="deleteUser('john.doe@example.com')" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-100 dark:border-gray-700">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">JS</div>
                                            <span>Jane Smith</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">jane.smith@example.com</td>
                                    <td class="py-3 px-4">
                                        <span class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-2 py-1 rounded-full text-xs">User</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-2 py-1 rounded-full text-xs">Active</span>
                                    </td>
                                    <td class="py-3 px-4">1 day ago</td>
                                    <td class="py-3 px-4">
                                        <button onclick="editUser('jane.smith@example.com')" class="text-blue-600 hover:text-blue-800 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="deleteUser('jane.smith@example.com')" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics Section -->
        <div id="analyticsSection" class="section hidden p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold mb-4">Traffic Sources</h3>
                    <canvas id="trafficChart" width="400" height="300"></canvas>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold mb-4">User Engagement</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Page Views</span>
                            <span class="font-semibold">12,345</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-primary h-2 rounded-full" style="width: 78%"></div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Session Duration</span>
                            <span class="font-semibold">4:32 min</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 65%"></div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Bounce Rate</span>
                            <span class="font-semibold">23.4%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 23%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Section -->
        <div id="settingsSection" class="section hidden p-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold">System Settings</h3>
                </div>
                <div class="p-6">
                    <form class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Site Name</label>
                            <input type="text" value="My Admin Panel" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-base">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">Admin Email</label>
                            <input type="email" value="admin@example.com" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-base">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">Default User Role</label>
                            <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-base">
                                <option>User</option>
                                <option>Moderator</option>
                                <option>Admin</option>
                            </select>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" id="maintenance" class="mr-2" checked>
                            <label for="maintenance" class="text-sm">Enable maintenance mode</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" id="registration" class="mr-2" checked>
                            <label for="registration" class="text-sm">Allow user registration</label>
                        </div>
                        
                        <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary/90 transition-colors">
                            Save Settings
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div id="addUserModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold">Add New User</h3>
            </div>
            <div class="p-6">
                <form class="space-y-4" onsubmit="addUser(event)">
                    <div>
                        <label class="block text-sm font-medium mb-2">Name</label>
                        <input type="text" id="userName" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-base">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Email</label>
                        <input type="email" id="userEmail" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-base">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Role</label>
                        <select id="userRole" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-base">
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <div class="flex space-x-3 pt-4">
                        <button type="submit" class="flex-1 bg-primary text-white py-2 rounded-lg hover:bg-primary/90 transition-colors">
                            Add User
                        </button>
                        <button type="button" onclick="hideAddUserModal()" class="flex-1 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 py-2 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Dark mode detection
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
            if (event.matches) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });

        // Navigation
        function showSection(sectionName) {
            // Hide all sections
            document.querySelectorAll('.section').forEach(section => {
                section.classList.add('hidden');
            });
            
            // Show selected section
            document.getElementById(sectionName + 'Section').classList.remove('hidden');
            
            // Update page title
            document.getElementById('pageTitle').textContent = sectionName.charAt(0).toUpperCase() + sectionName.slice(1);
            
            // Update active nav item
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active', 'bg-gray-100', 'dark:bg-gray-700');
            });
            event.target.classList.add('active', 'bg-gray-100', 'dark:bg-gray-700');
            
            // Close sidebar on mobile
            if (window.innerWidth < 1024) {
                toggleSidebar();
            }
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // User management
        function showAddUserModal() {
            document.getElementById('addUserModal').classList.remove('hidden');
        }

        function hideAddUserModal() {
            document.getElementById('addUserModal').classList.add('hidden');
            document.getElementById('userName').value = '';
            document.getElementById('userEmail').value = '';
            document.getElementById('userRole').value = 'User';
        }

        function addUser(event) {
            event.preventDefault();
            const name = document.getElementById('userName').value;
            const email = document.getElementById('userEmail').value;
            const role = document.getElementById('userRole').value;
            
            // Add new row to table
            const tbody = document.getElementById('usersTable');
            const initials = name.split(' ').map(n => n[0]).join('').toUpperCase();
            const newRow = `
                <tr class="border-b border-gray-100 dark:border-gray-700">
                    <td class="py-3 px-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">${initials}</div>
                            <span>${name}</span>
                        </div>
                    </td>
                    <td class="py-3 px-4">${email}</td>
                    <td class="py-3 px-4">
                        <span class="bg-${role === 'Admin' ? 'blue' : 'gray'}-100 dark:bg-${role === 'Admin' ? 'blue' : 'gray'}-900 text-${role === 'Admin' ? 'blue' : 'gray'}-800 dark:text-${role === 'Admin' ? 'blue' : 'gray'}-200 px-2 py-1 rounded-full text-xs">${role}</span>
                    </td>
                    <td class="py-3 px-4">
                        <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-2 py-1 rounded-full text-xs">Active</span>
                    </td>
                    <td class="py-3 px-4">Just now</td>
                    <td class="py-3 px-4">
                        <button onclick="editUser('${email}')" class="text-blue-600 hover:text-blue-800 mr-3">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteUser('${email}')" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.insertAdjacentHTML('afterbegin', newRow);
            hideAddUserModal();
        }

        function editUser(email) {
            alert(`Edit user: ${email}`);
        }

        function deleteUser(email) {
            if (confirm(`Are you sure you want to delete user: ${email}?`)) {
                // Find and remove the row
                const rows = document.querySelectorAll('#usersTable tr');
                rows.forEach(row => {
                    if (row.textContent.includes(email)) {
                        row.remove();
                    }
                });
            }
        }

        // Charts
        function initCharts() {
            // User Growth Chart
            const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
            new Chart(userGrowthCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Users',
                        data: [150, 230, 180, 320, 290, 450],
                        borderColor: '#5D5CDE',
                        backgroundColor: 'rgba(93, 92, 222, 0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Revenue Chart
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            new Chart(revenueCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Product Sales', 'Subscriptions', 'Services'],
                    datasets: [{
                        data: [45, 35, 20],
                        backgroundColor: ['#5D5CDE', '#10B981', '#F59E0B'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Traffic Chart
            const trafficCtx = document.getElementById('trafficChart').getContext('2d');
            new Chart(trafficCtx, {
                type: 'bar',
                data: {
                    labels: ['Direct', 'Social', 'Email', 'Search', 'Referral'],
                    datasets: [{
                        label: 'Visitors',
                        data: [1200, 850, 600, 2100, 400],
                        backgroundColor: '#5D5CDE',
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Initialize charts when page loads
        window.addEventListener('load', initCharts);
    </script>
</body>
</html>