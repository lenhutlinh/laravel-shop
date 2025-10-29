/**
 * Search Suggestions System
 * Hệ thống gợi ý tìm kiếm thông minh
 */

class SearchSuggestions {
    constructor() {
        this.searchInput = document.querySelector('.input-search');
        this.suggestionsContainer = null;
        this.currentSuggestions = [];
        this.selectedIndex = -1;
        this.debounceTimer = null;
        this.isVisible = false;
        
        this.init();
    }

    init() {
        if (!this.searchInput) return;

        this.createSuggestionsContainer();
        this.bindEvents();
        this.loadSearchHistory();
    }

    createSuggestionsContainer() {
        // Tạo container cho suggestions
        this.suggestionsContainer = document.createElement('div');
        this.suggestionsContainer.className = 'search-suggestions';

        // Thêm vào DOM
        const searchContainer = this.searchInput.closest('.nav-bar-bottom-center-search');
        if (searchContainer) {
            searchContainer.style.position = 'relative';
            searchContainer.appendChild(this.suggestionsContainer);
        }
    }

    bindEvents() {
        // Input events
        this.searchInput.addEventListener('input', (e) => {
            this.handleInput(e.target.value);
        });

        this.searchInput.addEventListener('keydown', (e) => {
            this.handleKeydown(e);
        });

        this.searchInput.addEventListener('focus', () => {
            if (this.searchInput.value.length >= 2) {
                this.showSuggestions();
            } else {
                this.showTrendingKeywords();
            }
        });

        this.searchInput.addEventListener('blur', (e) => {
            // Delay để cho phép click vào suggestions
            setTimeout(() => {
                this.hideSuggestions();
            }, 200);
        });

        // Click outside to close
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.nav-bar-bottom-center-search')) {
                this.hideSuggestions();
            }
        });
    }

    handleInput(value) {
        clearTimeout(this.debounceTimer);
        
        // Show loading state for better UX
        if (value.length >= 2) {
            this.showLoadingState();
        }
        
        this.debounceTimer = setTimeout(() => {
            if (value.length >= 2) {
                this.fetchSuggestions(value);
            } else if (value.length === 0) {
                this.showTrendingKeywords();
            } else {
                this.hideSuggestions();
            }
        }, 200); // Reduced debounce time for better responsiveness
    }

    handleKeydown(e) {
        if (!this.isVisible) return;

        switch (e.key) {
            case 'ArrowDown':
                e.preventDefault();
                this.navigateSuggestions(1);
                break;
            case 'ArrowUp':
                e.preventDefault();
                this.navigateSuggestions(-1);
                break;
            case 'Enter':
                e.preventDefault();
                this.selectSuggestion();
                break;
            case 'Escape':
                this.hideSuggestions();
                break;
        }
    }

    async fetchSuggestions(keyword) {
        try {
            const response = await fetch(`/api/search-suggestions?q=${encodeURIComponent(keyword)}`);
            const data = await response.json();
            
            this.currentSuggestions = data.suggestions || [];
            this.renderSuggestions(data.suggestions, data.type);
            
        } catch (error) {
            console.error('Error fetching suggestions:', error);
        }
    }

    async showTrendingKeywords() {
        try {
            const response = await fetch('/api/search-suggestions?q=');
            const data = await response.json();
            
            this.currentSuggestions = data.suggestions || [];
            this.renderSuggestions(data.suggestions, 'trending');
            
        } catch (error) {
            console.error('Error fetching trending keywords:', error);
        }
    }

    renderSuggestions(suggestions, type) {
        if (!suggestions || suggestions.length === 0) {
            this.hideSuggestions();
            return;
        }

        this.suggestionsContainer.innerHTML = '';

        // Simple Header
        const header = document.createElement('div');
        header.className = 'suggestion-header';
        
        if (type === 'trending') {
            header.innerHTML = '<i class="fas fa-fire"></i> Từ khóa hot';
        } else {
            header.innerHTML = '<i class="fas fa-search"></i> Gợi ý tìm kiếm';
        }
        
        this.suggestionsContainer.appendChild(header);

        // Simple Suggestions
        suggestions.forEach((suggestion, index) => {
            const item = document.createElement('div');
            item.className = 'suggestion-item';

            // Simple Icon
            const icon = document.createElement('i');
            icon.className = type === 'trending' ? 'fas fa-fire' : 'fas fa-search';
            
            // Simple Text
            const text = document.createElement('span');
            text.textContent = suggestion;

            item.appendChild(icon);
            item.appendChild(text);

            // Events
            item.addEventListener('mouseenter', () => {
                this.selectedIndex = index;
                this.updateSelection();
            });

            item.addEventListener('click', () => {
                this.selectSuggestion(suggestion);
            });

            this.suggestionsContainer.appendChild(item);
        });

        this.showSuggestions();
    }

    navigateSuggestions(direction) {
        this.selectedIndex += direction;
        
        if (this.selectedIndex < 0) {
            this.selectedIndex = this.currentSuggestions.length - 1;
        } else if (this.selectedIndex >= this.currentSuggestions.length) {
            this.selectedIndex = 0;
        }
        
        this.updateSelection();
    }

    updateSelection() {
        const items = this.suggestionsContainer.querySelectorAll('.suggestion-item');
        
        items.forEach((item, index) => {
            if (index === this.selectedIndex) {
                item.style.backgroundColor = '#e3f2fd';
                item.style.color = '#1976d2';
            } else {
                item.style.backgroundColor = '';
                item.style.color = '';
            }
        });
    }

    selectSuggestion(suggestion = null) {
        const selectedSuggestion = suggestion || this.currentSuggestions[this.selectedIndex];
        
        if (selectedSuggestion) {
            this.searchInput.value = selectedSuggestion;
            this.hideSuggestions();
            
            // Track search
            this.trackSearch(selectedSuggestion);
            
            // Submit form
            const form = this.searchInput.closest('form');
            if (form) {
                form.submit();
            }
        }
    }

    showSuggestions() {
        this.suggestionsContainer.style.display = 'block';
        this.isVisible = true;
        this.selectedIndex = -1;
    }

    hideSuggestions() {
        this.suggestionsContainer.style.display = 'none';
        this.isVisible = false;
        this.selectedIndex = -1;
    }

    showLoadingState() {
        this.suggestionsContainer.innerHTML = '';
        
        const loadingItem = document.createElement('div');
        loadingItem.className = 'suggestion-loading';
        loadingItem.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang tải...';
        this.suggestionsContainer.appendChild(loadingItem);
        
        this.showSuggestions();
    }

    async trackSearch(keyword) {
        try {
            await fetch('/api/track-search', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                },
                body: JSON.stringify({ keyword })
            });
        } catch (error) {
            console.error('Error tracking search:', error);
        }
    }

    async loadSearchHistory() {
        // Load search history for logged in users
        const userId = this.getUserId();
        if (userId) {
            try {
                const response = await fetch(`/api/search-history?user_id=${userId}`);
                const data = await response.json();
                
                if (data.history && data.history.length > 0) {
                    // Show history when input is empty
                    this.searchInput.addEventListener('focus', () => {
                        if (this.searchInput.value.length === 0) {
                            this.renderSearchHistory(data.history);
                        }
                    });
                }
            } catch (error) {
                console.error('Error loading search history:', error);
            }
        }
    }

    renderSearchHistory(history) {
        this.suggestionsContainer.innerHTML = '';

        const header = document.createElement('div');
        header.className = 'suggestion-header';
        header.innerHTML = '<i class="fas fa-history"></i> Lịch sử tìm kiếm';
        this.suggestionsContainer.appendChild(header);

        history.forEach((keyword, index) => {
            const item = document.createElement('div');
            item.className = 'suggestion-item';

            const icon = document.createElement('i');
            icon.className = 'fas fa-history';

            const text = document.createElement('span');
            text.textContent = keyword;

            item.appendChild(icon);
            item.appendChild(text);

            item.addEventListener('click', () => {
                this.selectSuggestion(keyword);
            });

            this.suggestionsContainer.appendChild(item);
        });

        this.showSuggestions();
    }

    getUserId() {
        // Get user ID from session or localStorage
        // This should be implemented based on your authentication system
        return localStorage.getItem('user_id') || null;
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new SearchSuggestions();
});

// Export for use in other scripts
window.SearchSuggestions = SearchSuggestions;
