@extends('layout')

@section('content')
<div class="container">
    <header>
        <h1>&#128197; My Calendar</h1>

        <!-- Clock -->
        <div class="clock-container">
            <div id="clock"></div>
        </div>

    </header>

    <!-- Calendar -->
    <div class="calendar">
        <div class="nav-btn-container">
            <button class="nav-btn">&laquo;</button>
            <h2 id="monthYear"></h2>
            <button class="nav-btn">&raquo;</button>
        </div>
        <div class="calendar-grid" id="calendar"></div>
    </div>

    <!-- Modal -->
    <div class="modal" id="eventModal">
        <div class="modal-content">
            <div id="eventSelectorWrapper">
                <label for="eventSelector">
                    <strong>Select Event:</strong>
                    <select name="" id="eventSelector">
                        <option disabled selected>Choose Event...</option>
                    </select>
                </label>
            </div>

            <!-- Main Form -->
            <form action="" method="POST" id="eventForm">
                @csrf

                <input type="hidden" name="eventId" id="eventId">

                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>

                <label for="description">Description:</label>
                <textarea name="description" id="description"></textarea>

                <label for="startDate">Start Date:</label>
                <input type="date" name="startDate" id="startDate" required>

                <label for="endDate">End Date:</label>
                <input type="date" name="endDate" id="endDate" required>

                <button type="submit">Save</button>
            </form>

            <!-- Delete Form -->
            <form action="" method="POST" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')

                <input type="hidden" name="eventId" id="eventId">
                <button type="submit" class="submit-btn">Delete</button>
            </form>

            <!-- Cancel -->
            <button type="button">Cancel</button>
        </div>
    </div>
</div>
@endsection