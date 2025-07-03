<?php
session_start();

// 1. Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// 2. Check if user is not a regular user (redirect admins)
if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
    header("Location: admin.php");
    exit();
}

$email = $_SESSION['email'];
?>

<!-- Rest of your HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#5D5CDE',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <!-- Mobile menu button -->
    <button id="mobile-menu-btn" class="lg:hidden fixed top-4 left-4 z-50 p-2 rounded-lg bg-primary text-white shadow-lg">
        <i class="fas fa-bars text-lg"></i>
    </button>

    <!-- Sidebar -->
    <div id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-white dark:bg-gray-800 shadow-xl transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="flex flex-col h-full">
            <!-- Logo/Header -->
            <div class="flex items-center justify-center h-16 bg-primary">
                <h2 class="text-xl font-bold text-white">
                    <i class="fas fa-user-circle mr-2"></i>
                    User Panel
                </h2>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="#" class="nav-item active flex items-center px-4 py-3 text-sm font-medium rounded-lg">
                    <i class="fas fa-home mr-3 text-lg"></i>
                    Dashboard
                </a>
                <a href="#" class="nav-item flex items-center px-4 py-3 text-sm font-medium rounded-lg">
                    <i class="fas fa-user mr-3 text-lg"></i>
                    My Profile
                </a>
                <a href="#" class="nav-item flex items-center px-4 py-3 text-sm font-medium rounded-lg">
                    <i class="fas fa-sticky-note mr-3 text-lg"></i>
                    My Notes
                </a>
                <a href="#" class="nav-item flex items-center px-4 py-3 text-sm font-medium rounded-lg">
                    <i class="fas fa-chart-bar mr-3 text-lg"></i>
                    Analytics
                </a>
                <a href="#" class="nav-item flex items-center px-4 py-3 text-sm font-medium rounded-lg">
                    <i class="fas fa-cog mr-3 text-lg"></i>
                    Settings
                </a>
                <a href="#" class="nav-item flex items-center px-4 py-3 text-sm font-medium rounded-lg">
                    <i class="fas fa-headset mr-3 text-lg"></i>
                    Support
                </a>
            </nav>

            <!-- Logout Button -->
            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
               <a href="logout.php" class="flex items-center w-full px-4 py-3 text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors duration-200">
              <i class="fas fa-sign-out-alt mr-3 text-lg"></i>Logout</a>

            </div>
        </div>
    </div>

    <!-- Sidebar overlay for mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black bg-opacity-50 lg:hidden hidden"></div>

    <!-- Main Content -->
    <div class="lg:ml-64 min-h-screen">
        <!-- Header -->
        <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
            <div class="px-4 py-6 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <div class="ml-12 lg:ml-0">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                            Welcome back, John!
                        </h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Here's what's happening with your account today.
                        </p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">John Doe</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">john@example.com</p>
                        </div>
                        <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="px-4 py-6 sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Notes</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">15</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                            <i class="fas fa-sticky-note text-blue-600 dark:text-blue-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-600 dark:text-green-400 font-medium">+12%</span>
                        <span class="text-gray-500 dark:text-gray-400 ml-1">from last week</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Messages</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">3</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                            <i class="fas fa-envelope text-green-600 dark:text-green-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-600 dark:text-green-400 font-medium">+2</span>
                        <span class="text-gray-500 dark:text-gray-400 ml-1">new today</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Reminders</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">8</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bell text-yellow-600 dark:text-yellow-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-red-600 dark:text-red-400 font-medium">3</span>
                        <span class="text-gray-500 dark:text-gray-400 ml-1">due today</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Productivity</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">87%</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-line text-purple-600 dark:text-purple-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-600 dark:text-green-400 font-medium">+5%</span>
                        <span class="text-gray-500 dark:text-gray-400 ml-1">improvement</span>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Activity -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Activity</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                                    <i class="fas fa-sticky-note text-blue-600 dark:text-blue-400 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Created new note</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">"Project Planning Ideas" - 2 hours ago</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-green-600 dark:text-green-400 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Completed task</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">"Review quarterly reports" - 4 hours ago</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center">
                                    <i class="fas fa-envelope text-purple-600 dark:text-purple-400 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Received message</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">From support team - 6 hours ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reminders Panel -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Today's Reminders</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                    <span class="text-sm text-gray-900 dark:text-white">Finish project report</span>
                                </div>
                                <span class="text-xs text-yellow-600 dark:text-yellow-400">Due 3 PM</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-red-50 dark:bg-red-900/20 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                    <span class="text-sm text-gray-900 dark:text-white">Team meeting</span>
                                </div>
                                <span class="text-xs text-red-600 dark:text-red-400">Due 5 PM</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                    <span class="text-sm text-gray-900 dark:text-white">Review meeting notes</span>
                                </div>
                                <span class="text-xs text-blue-600 dark:text-blue-400">Tomorrow</span>
                            </div>
                        </div>
                        <button class="w-full mt-4 px-4 py-2 text-sm font-medium text-primary hover:text-primary/80 border border-primary rounded-lg hover:bg-primary/5 transition-colors duration-200">
                            View All Reminders
                        </button>
                    </div>
                </div>
            </div>

            <!-- Account Information -->
            <div class="mt-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Account Information</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Address</label>
                            <p class="text-sm text-gray-900 dark:text-white mt-1">john@example.com</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Membership</label>
                            <div class="flex items-center mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                    Premium
                                </span>
                            </div>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Member Since</label>
                            <p class="text-sm text-gray-900 dark:text-white mt-1">January 2024</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Dark mode detection and handling
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

        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        }

        mobileMenuBtn.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);

        // Navigation item handling
        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                // Remove active class from all items
                navItems.forEach(nav => nav.classList.remove('active'));
                // Add active class to clicked item
                item.classList.add('active');
            });
        });

        // Add styles for active navigation item
        const style = document.createElement('style');
        style.textContent = `
            .nav-item {
                @apply text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200;
            }
            .nav-item.active {
                @apply bg-primary text-white;
            }
            .nav-item.active:hover {
                @apply bg-primary/90 text-white;
            }
        `;
        document.head.appendChild(style);

        // Add some interactive features
        document.addEventListener('DOMContentLoaded', function() {
            // Animate stats on load
            const statNumbers = document.querySelectorAll('.text-3xl');
            statNumbers.forEach(stat => {
                const finalValue = parseInt(stat.textContent);
                if (!isNaN(finalValue)) {
                    let currentValue = 0;
                    const increment = finalValue / 20;
                    const timer = setInterval(() => {
                        currentValue += increment;
                        if (currentValue >= finalValue) {
                            stat.textContent = finalValue;
                            clearInterval(timer);
                        } else {
                            stat.textContent = Math.floor(currentValue);
                        }
                    }, 50);
                }
            });
        });
    </script>
</body>
</html>