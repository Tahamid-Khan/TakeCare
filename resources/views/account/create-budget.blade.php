@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .custom-container {
            max-width: 800px;
            margin: auto;
        }
    </style>

    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Create Budget</h2>

                <div class="p-4 col-md-6">
                    <form id="budget-form" action="" method="POST">@csrf
                        <!-- Department Selection -->
                        <div class="row">
                            <div class="col-12 col-md-6 form-group">
                                <label for="date">Month</label>
                                <input type="month" class="form-control"
                                       value="{{ \Carbon\Carbon::now()->format('Y-m') }}" id="date" name="forMonth">
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label for="department" class="form-label">Select Department</label>
                                <select id="department" name="department_id" class="form-select form-control">
                                    <option>Select a department</option>
                                    @foreach($fundDepartments as $item)
                                        <option class="capitalize"
                                                value="{{ $item->id }}">{{ $item->fund->type }} Fund
                                            - {{ $item->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <!-- Budget Items -->
                        <div id="budget-items" class="mb-3">
                            <h2 class="h5 mb-3">Budget Items</h2>
                            <div class="row mb-3 item">
                                <div class="mr-2 mb-2 col-md-6 col-12">
                                    <input type="text" class="form-control" placeholder="Item Name"
                                        name="items[0][name]">
                                </div>
                                <div class="mr-2 mb-2 col-md-3 col-12">
                                    <input type="number" class="form-control estimated-budget"
                                        placeholder="Estimated Budget" name="items[0][budget]">
                                </div>
                                <button type="button" class="btn btn-outline-danger remove-item mb-2 ml-2">&times;</button>
                            </div>
                        </div>
                        <button type="button" id="add-item" class="btn btn-outline-primary mb-3">+</button>

                        <div class="mb-4">
                            <h3 class="h5 mb-2">Total Budget: <span id="total-price">0</span></h3>
                            <input type="hidden" id="total_price_input" name="total_budget" value="0">
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="btn btn-primary">Submit Budget</button>
                        </div>
                    </form>

                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom_js')
    <script>
        let itemCount = 1;

        // Add new budget item
        document.getElementById('add-item').addEventListener('click', () => {
            const itemContainer = document.createElement('div');
            itemContainer.classList.add('row', 'mb-3', 'item');
            itemContainer.innerHTML = `
                    <div class="mr-2 mb-2 col-md-6 col-12">
                        <input type="text" class="form-control" placeholder="Item Name" name="items[${itemCount}][name]">
                    </div>
                    <div class="mr-2 mb-2 col-md-3 col-12">
                        <input type="number" class="form-control estimated-budget" placeholder="Estimated Budget" name="items[${itemCount}][budget]">
                    </div>
                    <button type="button" class="btn btn-outline-danger remove-item mb-2 ml-2">&times;</button>`;
            document.getElementById('budget-items').appendChild(itemContainer);
            itemCount++;
            addRemoveListeners();
            calculateTotal();
        });

        // Remove item and recalculate total
        function addRemoveListeners() {
            document.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.target.closest('.item').remove();
                    calculateTotal();
                });
            });
        }

        // Calculate total budget
        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.estimated-budget').forEach(input => {
                total += parseFloat(input.value) || 0;
            });
            document.getElementById('total-price').innerText = total.toFixed(2);
            document.getElementById('total_price_input').value = total.toFixed(2);
        }

        // Initialize event listeners
        addRemoveListeners();
        document.getElementById('budget-form').addEventListener('input', calculateTotal);
    </script>
@endpush
