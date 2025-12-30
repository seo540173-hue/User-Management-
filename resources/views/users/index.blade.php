<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.user_management') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100">
                <div class="p-8">
                    @if (session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-xl mb-8 flex items-center shadow-sm" role="alert">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <div>
                            <strong class="font-bold">{{ __('messages.success') }}</strong>
                            <span class="block sm:inline ml-1">{{ session('success') }}</span>
                        </div>
                    </div>
                    @endif

                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
                        <div>
                            <h3 class="text-3xl font-black text-gray-900 tracking-tight">{{ __('messages.all_users') }}</h3>
                            <p class="text-sm text-gray-500 mt-1 font-medium italic">Manage system access and user profiles</p>
                        </div>
                        @can('create-users')
                        <a href="{{ route('users.create') }}" class="inline-flex items-center px-6 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-blue-200 hover:shadow-xl hover:scale-[1.02] transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            {{ __('messages.add_user') }}
                        </a>
                        @endcan
                    </div>
                    
                    <div class="relative overflow-hidden rounded-2xl border border-gray-100 shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-white uppercase bg-gray-900">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 font-bold tracking-wider">{{ __('messages.id') }}</th>
                                        <th scope="col" class="px-6 py-4 font-bold tracking-wider">{{ __('messages.name') }}</th>
                                        <th scope="col" class="px-6 py-4 font-bold tracking-wider">{{ __('messages.role') }}</th>
                                        <th scope="col" class="px-6 py-4 font-bold tracking-wider">{{ __('messages.created_at') }}</th>
                                        <th scope="col" class="px-6 py-4 font-bold tracking-wider text-center">{{ __('messages.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($users as $user)
                                    <tr class="bg-white hover:bg-blue-50/30 transition-colors duration-200">
                                        <td class="px-6 py-4 font-mono text-xs text-blue-600 font-bold">
                                            #{{ $user->id }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center text-white font-bold text-sm shadow-md">
                                                    {{ substr($user->name, 0, 1) }}
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-bold text-gray-900">{{ $user->name }}</div>
                                                    <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $roleColors = [
                                                    'Admin' => 'bg-red-100 text-red-800 border-red-200',
                                                    'Manager' => 'bg-purple-100 text-purple-800 border-purple-200',
                                                    'Staff' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                    'User' => 'bg-green-100 text-green-800 border-green-200',
                                                ];
                                                $role = $user->roles->first()?->name ?? 'User';
                                                $badgeColor = $roleColors[$role] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $badgeColor }}">
                                                {{ $user->roles->pluck('name')->implode(', ') ?: 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-xs font-medium text-gray-500">
                                            {{ $user->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-center space-x-2">
                                                @can('view-users')
                                                <a href="{{ route('users.show', $user->id) }}" class="p-2 bg-gray-50 text-gray-600 rounded-lg border border-gray-200 hover:bg-cyan-50 hover:text-cyan-600 hover:border-cyan-200 transition-all shadow-sm group" title="{{ __('messages.show') }}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                </a>
                                                @endcan
                                                @can('edit-users')
                                                <a href="{{ route('users.edit', $user->id) }}" class="p-2 bg-gray-50 text-gray-600 rounded-lg border border-gray-200 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition-all shadow-sm group" title="{{ __('messages.edit') }}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                </a>
                                                @endcan
                                                @can('delete-users')
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ __('messages.confirm_delete_user') }}');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 bg-gray-50 text-gray-600 rounded-lg border border-gray-200 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all shadow-sm group" title="{{ __('messages.delete') }}">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-6 border-t border-gray-100 pt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
