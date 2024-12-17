@extends('admin.app-admin')

@section('title', __('Tickets'))

@section('content')
    <h1 class="text-2xl text-center">{{ __('Ticket') }} - {{ $ticket->code }}</h1>

    <x-admin.card-show>
        <x-slot name="cardInformation">
            <x-admin.span-information
                :label="__('Code')"
                :value="$ticket->code"
            />
            <x-admin.span-information
                :label="__('User')"
                :value="$ticket->user->username"
                :href="route('users.show', $ticket->user->id)"
            />
            <x-admin.span-information
                :label="__('Post Title')"
                :value="Str::limit($ticket->post->title, 15)"
                :href="route('posts.show', $ticket->post->id)"
            />
            <x-admin.span-information
                :label="__('Place')"
                :value="$ticket->place"
            />
            <x-admin.span-information
                :label="__('Created At')"
                :value="$ticket->created_at->diffForHumans()"
            />
            <x-admin.span-information
                :label="__('Updated At')"
                :value="$ticket->updated_at->diffForHumans()"
            />
            <x-admin.span-information
                :label="__('Active')"
                :value="$ticket->is_active ? __('Yes') : __('No')"
            />
        </x-slot>

        <x-slot name="cardActionButtons">
            <x-admin.action-buttons
                :model="$ticket"
                :routeEdit="route('tickets.edit', $ticket->id)"
                :routeEnable="route('tickets.active', $ticket->id)"
                :routeDisable="route('tickets.destroy', $ticket->id)"
            />
        </x-slot>
    </x-admin.card-show>
@endsection