<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashish Editorial | Secure Admin Console</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#050505] text-white font-sans antialiased">

    <div class="min-h-screen p-6 md:p-12 max-w-7xl mx-auto space-y-8">
        <div class="flex justify-between items-center border-b border-white/10 pb-6">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight">Ashish Editorial</h1>
                <p class="text-sm text-gray-400">Order Verification & Vault Management Panel</p>
            </div>
            <span class="px-4 py-1.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 rounded-full text-xs font-mono">System Live</span>
        </div>

        @if(session('success'))
            <div class="bg-emerald-500/20 border border-emerald-500/30 text-emerald-300 p-4 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-[#101010] border border-white/5 rounded-xl overflow-hidden shadow-2xl">
            <div class="p-6 border-b border-white/5">
                <h2 class="text-lg font-bold">Incoming Payment Requests (Pending Manual UTR Verification)</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/5 text-[11px] uppercase tracking-wider text-gray-400 border-b border-white/5">
                            <th class="p-4">Ref ID</th>
                            <th class="p-4">Customer Email</th>
                            <th class="p-4">Asset Title</th>
                            <th class="p-4">UTR Number</th>
                            <th class="p-4">Price</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-sm">
                        @forelse($transactions as $tx)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="p-4 font-mono text-gray-400">{{ $tx->order_reference_id }}</td>
                                <td class="p-4 font-semibold">{{ $tx->customer_email }}</td>
                                <td class="p-4 text-cyan-400">{{ $tx->product->title }}</td>
                                <td class="p-4 font-mono text-amber-400 tracking-wider">{{ $tx->upi_utr_number ?? 'N/A' }}</td>
                                <td class="p-4">₹{{ $tx->amount_paid }}</td>
                                <td class="p-4">
   <span class="px-2.5 py-1 rounded-full text-xs font-medium 
    {{ $tx->payment_status === 'completed' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-amber-500/10 text-amber-400 border border-amber-500/20' }}">
    {{ strtoupper($tx->payment_status) }}
</span>
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    @if($tx->payment_status === 'pending')
                                        <form action="{{ route('admin.approve', $tx->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-4 py-1.5 bg-emerald-500 text-black font-bold text-xs rounded hover:bg-emerald-400 transition-all">
                                                Approve Order
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-gray-500 font-mono">Tokens Dispatched</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-12 text-center text-gray-500 font-mono text-sm">Bhai, abhi tak koi incoming request nahi aayi hai.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>