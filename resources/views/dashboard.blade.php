<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('messages.dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Sales Card -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg transform hover:scale-105 transition-transform duration-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-blue-100 font-medium mb-1">{{ __('messages.sales') }}</p>
                            <h3 class="text-3xl font-bold">{{ __('messages.lkr') }} {{ number_format($stats['total_sales'], 2) }}</h3>
                            <p class="text-xs text-blue-200 mt-2 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                {{ $stats['sales_count'] }} {{ __('messages.transactions') }}
                            </p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Products Card -->
                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-6 text-white shadow-lg transform hover:scale-105 transition-transform duration-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-emerald-100 font-medium mb-1">{{ __('messages.products') }}</p>
                            <h3 class="text-3xl font-bold">{{ $stats['products_count'] }}</h3>
                            <p class="text-xs text-emerald-200 mt-2">{{ __('messages.active_stock') }}</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Customers Card -->
                <div class="bg-gradient-to-br from-violet-500 to-violet-600 rounded-2xl p-6 text-white shadow-lg transform hover:scale-105 transition-transform duration-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-violet-100 font-medium mb-1">{{ __('messages.customers') }}</p>
                            <h3 class="text-3xl font-bold">{{ $stats['customers_count'] }}</h3>
                            <p class="text-xs text-violet-200 mt-2">{{ __('messages.registered') }}</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Card -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border-l-8 border-red-500 transform hover:scale-105 transition-transform duration-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 font-bold uppercase text-xs tracking-wider mb-1">{{ __('messages.low_stock_warning') }}</p>
                            <h3 class="text-3xl font-bold text-red-600">{{ $stats['low_stock']->count() }}</h3>
                            <p class="text-xs text-red-500 mt-2 font-medium">{{ __('messages.items_below_10') }}</p>
                        </div>
                        <div class="p-3 bg-red-50 rounded-xl">
                            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Sales -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                    <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                        <div>
                            <h3 class="font-bold text-lg text-gray-800">{{ __('messages.recent_sales') }}</h3>
                            <p class="text-xs text-gray-500">Latest transactions</p>
                        </div>
                        <a href="{{ route('sales.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold flex items-center transition-colors">
                            {{ __('messages.view_all_sales') }}
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @foreach($stats['recent_sales'] as $sale)
                        <div class="p-4 hover:bg-blue-50/30 transition-colors flex items-center justify-between group">
                            <div class="flex items-center space-x-4">
                                <div class="bg-blue-100 text-blue-600 w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs">
                                    {{ substr($sale->customer_name, 0, 2) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm">{{ $sale->customer_name }}</p>
                                    <p class="text-xs text-gray-500">{{ $sale->product_name }} <span class="text-gray-300">|</span> Qty: {{ $sale->quantity }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-blue-600 text-sm">{{ __('messages.lkr') }} {{ number_format($sale->total, 2) }}</p>
                                <p class="text-[10px] text-gray-400 font-medium">{{ \Carbon\Carbon::parse($sale->sale_date)->diffForHumans() }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Stock Alert Table -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                    <div class="p-6 border-b border-gray-50 bg-red-50/30">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                            <h3 class="font-bold text-lg text-gray-800">{{ __('messages.stock_alerts') }}</h3>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        @if($stats['low_stock']->isEmpty())
                            <div class="text-center py-8">
                                <div class="w-12 h-12 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <p class="text-gray-500 text-sm font-medium">{{ __('messages.stock_good') }}</p>
                            </div>
                        @else
                            <div class="space-y-3">
                                @foreach($stats['low_stock']->take(5) as $p)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-1.5 h-10 bg-red-400 rounded-l-full"></div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">{{ $p->name }}</p>
                                            <p class="text-xs text-gray-500">{{ __('messages.code') }}: {{ $p->code }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="px-3 py-1 rounded-lg bg-red-100 text-red-700 font-bold text-xs" title="Current Stock">
                                            {{ $p->stock_quantity }}
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                                @if($stats['low_stock']->count() > 5)
                                    <div class="text-center pt-2">
                                        <span class="text-xs text-gray-400 italic">+{{ $stats['low_stock']->count() - 5 }} {{ __('messages.more') }}</span>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
