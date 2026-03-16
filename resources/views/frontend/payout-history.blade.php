@extends('layouts.frontend.master')

@section('css')
    <style>
       .player-controls {
        display:none !Important;
       }
    .secPayout-history {
        position:relative;
        padding:4rem 0;
    }

    .secPayout-history .container {
    ///max-width: 1400px;
   // margin: 0 auto;
}

/* Header Section */
.secPayout-history .page-header {
    margin-bottom: 2rem;
}

.secPayout-history .back-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #ffffff !important;
    text-decoration: none;
    font-size: 0.9rem;
    margin-bottom: 1rem;
    transition: color 0.3s;
}

.secPayout-history .back-link:hover {
    color: #8b5cf6;
}

.secPayout-history .page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    background: linear-gradient(45deg, #a877ff, #ffffff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-family: 'Poppins';
}

.secPayout-history .page-subtitle {
    color: #f5f5f5;
    font-size: 1rem;
}

/* Summary Cards */
.secPayout-history .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.secPayout-history .summary-card {
    background: #16002dc7;
    border-radius: 16px;
    padding: 1.5rem;
    border: 1px solid rgb(139 92 246 / 51%);
    transition: all 0.3s ease;
}

.secPayout-history .summary-card:hover {
    border-color: rgba(139, 92, 246, 0.5);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(139, 92, 246, 0.2);
}

.secPayout-history .summary-label {
    font-size: 0.85rem;
    color: #e1e1e1;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.secPayout-history .summary-value {
    font-size: 2rem;
    font-weight: 700;
    color: white;
}

.secPayout-history .summary-change {
    font-size: 0.85rem;
    color: #dbc6ff;
    margin-top: 0.5rem;
}

/* Filters Section */
.secPayout-history .filters-section {
    background: #16002dc7;
    border-radius: 16px;
    padding: 1.5rem;
    border: 1px solid rgb(139 92 246 / 51%);
    margin-bottom: 2rem;
}

.secPayout-history .filters-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    align-items: end;
}

.secPayout-history .filter-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.secPayout-history .filter-label {
    font-size: 0.85rem;
    color: #ffffff ;
    font-weight: 500;
}

.secPayout-history .filter-input,
.secPayout-history .filter-select {
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 10px;
    padding: 0.75rem 1rem;
    color: white;
    font-size: 0.9rem;
    transition: all 0.3s;
    outline: none;
}

.secPayout-history .filter-input:focus,
.secPayout-history .filter-select:focus {
    border-color: #8b5cf6;
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
}

.secPayout-history .filter-select {
    cursor: pointer;
    color:#dbc6ff !important;
}

.secPayout-history .filter-select option {
    background: #1a1830;
    color: white;
}

.secPayout-history .filter-actions {
    display: flex;
    gap: 0.75rem;
}

.secPayout-history .btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 10px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.secPayout-history .btn-primary {
    background: linear-gradient(45deg, #a877ff, #ac57f9);
    color: white;
}

.secPayout-history .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(139, 92, 246, 0.4);
}

.secPayout-history .btn-secondary {
    background: rgba(139, 92, 246, 0.1);
    color: #a0a0c0;
    border: 1px solid rgba(139, 92, 246, 0.3);
}

.secPayout-history .btn-secondary:hover {
    background: rgba(139, 92, 246, 0.2);
    color: white;
}

/* Table Section */
.secPayout-history .table-container {
    background: #16002dc7;
    border-radius: 16px;
    border: 1px solid rgb(139 92 246 / 51%);
    overflow: hidden;
}

.secPayout-history .table-header {
    background: linear-gradient(45deg, #a877ff, #7841a9);
    padding: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.secPayout-history .table-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: white;
}

.secPayout-history .table-count {
    font-size: 0.9rem;
    opacity: 0.9;
    color: white;
}

.secPayout-history .table-wrapper {
    overflow-x: auto;
}

.secPayout-history table {
    width: 100%;
    border-collapse: collapse;
}

.secPayout-history thead {
    background: rgba(139, 92, 246, 0.15);
}

.secPayout-history th {
    text-align: left;
    padding: 1rem 1.5rem;
    font-size: 0.85rem;
    font-weight: 600;
    color: color: #ffffff;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.secPayout-history tbody tr {
    border-bottom: 1px solid rgba(139, 92, 246, 0.1);
    transition: all 0.3s;
}

.secPayout-history tbody tr:hover {
    background: rgba(139, 92, 246, 0.05);
}

.secPayout-history td {
    padding: 1.25rem 1.5rem;
    font-size: 0.95rem;
}

.secPayout-history .date-cell {
    color: #ffffff;
     font-family: 'Poppins';
}

.secPayout-history .ref-cell {
    font-family: 'Poppins';
    color: #c3a1ff ;
    font-size: 0.85rem;
}

.secPayout-history .amount-cell {
    font-weight: 700;
    font-size: 1.1rem;
}

.secPayout-history .status-badge {
    display: inline-block;
    padding: 0.4rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.secPayout-history .status-completed {
    background: rgba(16, 185, 129, 0.2);
    color: #10b981;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.secPayout-history .status-pending {
    background: rgba(245, 158, 11, 0.2);
    color: #f59e0b;
    border: 1px solid rgba(245, 158, 11, 0.3);
}

.secPayout-history .status-failed {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.secPayout-history .method-cell {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #a0a0c0;
}

.secPayout-history .method-icon {
    font-size: 1.2rem;
}

/* Pagination */
.secPayout-history .pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    padding: 2rem;
    margin-top: 2rem;
}

.secPayout-history .pagination-btn {
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #1a1830 0%, #252140 100%);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 10px;
    color: white;
    cursor: pointer;
    transition: all 0.3s;
}

.secPayout-history .pagination-btn:hover:not(:disabled) {
    background: linear-gradient(135deg, #ab8bf3, #9d6af5);
    border-color: transparent;
}

.secPayout-history .pagination-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

.secPayout-history .pagination-info {
    color: #a0a0c0;
    font-size: 0.9rem;
}

/* Empty State */
.secPayout-history .empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: #a0a0c0;
}

.secPayout-history .empty-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

/* Responsive */
@media (max-width: 768px) {
    .secPayout-history body {
        padding: 1rem;
    }

    .secPayout-history .page-title {
        font-size: 2rem;
    }

    .secPayout-history .filters-grid {
        grid-template-columns: 1fr;
    }

    .secPayout-history .table-wrapper {
        overflow-x: scroll;
    }

    .secPayout-history table {
        min-width: 800px;
    }

    .secPayout-history .pagination {
        flex-wrap: wrap;
    }
}
    </style>
@endsection

@section('content')

   <section class="secPayout-history">
        <div class="container">
            <!-- Header -->
            <div class="page-header">
                <a href="/" class="back-link">
                    ← Back to Home
                </a>
                <h1 class="page-title">Payout History</h1>
                <p class="page-subtitle">Track all your earnings, completed and pending payouts in one place</p>
            </div>

            <!-- Summary Cards -->
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-label">
                        <span>💰</span>
                        Total Earnings
                    </div>
                    <div class="summary-value">$45,230</div>
                    <div class="summary-change">↑ 18% from last period</div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">
                        <span>✓</span>
                        Total Paid
                    </div>
                    <div class="summary-value">$40,730</div>
                    <div class="summary-change">24 transactions completed</div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">
                        <span>⏳</span>
                        Pending Payouts
                    </div>
                    <div class="summary-value">$4,500</div>
                    <div class="summary-change">Next payout: Jan 15, 2025</div>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="filters-section">
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">Date Range</label>
                        <select class="filter-select" id="dateRange">
                            <option value="all">All Time</option>
                            <option value="month">This Month</option>
                            <option value="quarter">This Quarter</option>
                            <option value="year">This Year</option>
                            <option value="custom">Custom Range</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Status</label>
                        <select class="filter-select" id="statusFilter">
                            <option value="all">All Status</option>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Sort By</label>
                        <select class="filter-select" id="sortBy">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="highest">Highest Amount</option>
                            <option value="lowest">Lowest Amount</option>
                        </select>
                    </div>

                    <div class="filter-group filter-actions">
                        <button class="btn btn-primary" onclick="applyFilters()">Apply Filters</button>
                        <button class="btn btn-secondary" onclick="resetFilters()">Reset</button>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="table-container">
                <div class="table-header">
                    <div class="table-title">Transaction History</div>
                    <div class="table-count"><span id="recordCount">24</span> Records</div>
                </div>

                <div class="table-wrapper">
                    <table id="payoutTable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Transaction Ref</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Payment Method</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <!-- Rows will be dynamically inserted -->
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    <button class="pagination-btn" id="prevBtn" onclick="previousPage()">← Previous</button>
                    <span class="pagination-info">Page <span id="currentPage">1</span> of <span id="totalPages">3</span></span>
                    <button class="pagination-btn" id="nextBtn" onclick="nextPage()">Next →</button>
                </div>
            </div>
        </div>
    </section>

     <script>
        // Sample data
        const payoutData = [
            { date: 'Dec 15, 2024', ref: 'TXN-2024-0024', amount: 2150, status: 'completed', method: 'Bank Transfer' },
            { date: 'Dec 01, 2024', ref: 'TXN-2024-0023', amount: 1980, status: 'completed', method: 'PayPal' },
            { date: 'Nov 15, 2024', ref: 'TXN-2024-0022', amount: 2340, status: 'completed', method: 'Bank Transfer' },
            { date: 'Nov 01, 2024', ref: 'TXN-2024-0021', amount: 1750, status: 'completed', method: 'Stripe' },
            { date: 'Oct 15, 2024', ref: 'TXN-2024-0020', amount: 2100, status: 'completed', method: 'Bank Transfer' },
            { date: 'Oct 01, 2024', ref: 'TXN-2024-0019', amount: 1890, status: 'completed', method: 'PayPal' },
            { date: 'Sep 15, 2024', ref: 'TXN-2024-0018', amount: 2450, status: 'completed', method: 'Bank Transfer' },
            { date: 'Sep 01, 2024', ref: 'TXN-2024-0017', amount: 1670, status: 'completed', method: 'Stripe' },
            { date: 'Jan 15, 2025', ref: 'TXN-2025-0025', amount: 2300, status: 'pending', method: 'Bank Transfer' },
            { date: 'Jan 01, 2025', ref: 'TXN-2025-0026', amount: 2200, status: 'pending', method: 'PayPal' },
            { date: 'Aug 15, 2024', ref: 'TXN-2024-0016', amount: 1950, status: 'failed', method: 'Bank Transfer' },
            { date: 'Aug 01, 2024', ref: 'TXN-2024-0015', amount: 1820, status: 'completed', method: 'PayPal' },
        ];

        let currentPage = 1;
        const rowsPerPage = 8;
        let filteredData = [...payoutData];

        function renderTable() {
            const tbody = document.getElementById('tableBody');
            tbody.innerHTML = '';

            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const pageData = filteredData.slice(start, end);

            if (pageData.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-icon">📭</div>
                                <p>No payouts found matching your filters</p>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            pageData.forEach(payout => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="date-cell">${payout.date}</td>
                    <td class="ref-cell">${payout.ref}</td>
                    <td class="amount-cell">$${payout.amount.toLocaleString()}</td>
                    <td>
                        <span class="status-badge status-${payout.status}">
                            ${payout.status}
                        </span>
                    </td>
                    <td>
                        <div class="method-cell">
                            <span class="method-icon">${getMethodIcon(payout.method)}</span>
                            ${payout.method}
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });

            updatePagination();
        }

        function getMethodIcon(method) {
            const icons = {
                'Bank Transfer': '🏦',
                'PayPal': '💳',
                'Stripe': '💰'
            };
            return icons[method] || '💵';
        }

        function updatePagination() {
            const totalPages = Math.ceil(filteredData.length / rowsPerPage);
            document.getElementById('currentPage').textContent = currentPage;
            document.getElementById('totalPages').textContent = totalPages;
            document.getElementById('recordCount').textContent = filteredData.length;

            document.getElementById('prevBtn').disabled = currentPage === 1;
            document.getElementById('nextBtn').disabled = currentPage === totalPages;
        }

        function previousPage() {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        }

        function nextPage() {
            const totalPages = Math.ceil(filteredData.length / rowsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
            }
        }

        function applyFilters() {
            const statusFilter = document.getElementById('statusFilter').value;
            const sortBy = document.getElementById('sortBy').value;

            filteredData = [...payoutData];

            // Filter by status
            if (statusFilter !== 'all') {
                filteredData = filteredData.filter(p => p.status === statusFilter);
            }

            // Sort
            if (sortBy === 'newest') {
                filteredData.sort((a, b) => new Date(b.date) - new Date(a.date));
            } else if (sortBy === 'oldest') {
                filteredData.sort((a, b) => new Date(a.date) - new Date(b.date));
            } else if (sortBy === 'highest') {
                filteredData.sort((a, b) => b.amount - a.amount);
            } else if (sortBy === 'lowest') {
                filteredData.sort((a, b) => a.amount - b.amount);
            }

            currentPage = 1;
            renderTable();
        }

        function resetFilters() {
            document.getElementById('dateRange').value = 'all';
            document.getElementById('statusFilter').value = 'all';
            document.getElementById('sortBy').value = 'newest';
            filteredData = [...payoutData];
            currentPage = 1;
            renderTable();
        }

        function goBack() {
            alert('Returning to dashboard...');
            // window.history.back();
        }

        // Initial render
        renderTable();
    </script>
@endsection

