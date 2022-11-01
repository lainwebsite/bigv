<div class="col-6">
    <h5>Customer Total Transactions</h5>
    <h3 class="text-orange"><b>{{ $transactions->count() }}</b></h3>
    @php
        $spend = 0;
        foreach ($transactions as $key => $transaction) {
            $spend += $transaction->total_price;
        }
    @endphp
    <h5>Customer Total Spending</h5>
    <h3 class="text-orange"><b>${{ $spend }}</b></h3>
</div>
<div class="col-6">
    <h5>Customer's Average Order Amount</h5>
    <h3 class="text-orange"><b>${{ $spend / $transactions->count() }}</b></h3>
    @php
        $days = 0;
        foreach ($transactions as $key => $transaction) {
            if ($key != 0) {
                $interval = $transactions[$key - 1]->created_at->diff($transactions[$key]->created_at);
                $day = $interval->format('%a');
                $days += $day;
            }
        }
        $interval = $days / ($transactions->count() - 1);
    @endphp
    <h5 class="mt-3">Customer's Interval between Orders</h5>
    <h3 class="text-orange"><b>{{ $days }} day(s)</b></h3>
</div>
