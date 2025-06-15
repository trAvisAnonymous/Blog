// Insurance Calculator JavaScript

class InsuranceCalculator {
    constructor() {
        this.initializeCalculator();
    }
    
    initializeCalculator() {
        const calculator = document.querySelector('.insurance-calculator');
        if (!calculator) return;
        
        // Initialize form elements
        this.form = calculator.querySelector('form');
        this.resultContainer = calculator.querySelector('.calculator-result');
        
        if (this.form) {
            this.form.addEventListener('submit', (e) => this.handleSubmit(e));
            this.initializeInputListeners();
        }
    }
    
    initializeInputListeners() {
        const inputs = this.form.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('change', () => this.updateEstimate());
            input.addEventListener('input', () => this.updateEstimate());
        });
    }
    
    handleSubmit(e) {
        e.preventDefault();
        const formData = new FormData(this.form);
        const data = Object.fromEntries(formData.entries());
        
        // Calculate insurance estimate
        const estimate = this.calculateEstimate(data);
        
        // Display result
        this.displayResult(estimate);
    }
    
    calculateEstimate(data) {
        let basePremium = 0;
        
        // Base premium based on insurance type
        switch(data.insuranceType) {
            case 'auto':
                basePremium = 1000;
                break;
            case 'home':
                basePremium = 800;
                break;
            case 'health':
                basePremium = 500;
                break;
            case 'life':
                basePremium = 300;
                break;
            default:
                basePremium = 0;
        }
        
        // Apply modifiers based on other factors
        if (data.coverage) {
            basePremium *= (1 + (parseFloat(data.coverage) / 100));
        }
        
        if (data.deductible) {
            basePremium *= (1 - (parseFloat(data.deductible) / 1000));
        }
        
        // Apply risk factors
        if (data.riskFactors) {
            data.riskFactors.forEach(factor => {
                basePremium *= 1.1; // 10% increase per risk factor
            });
        }
        
        return {
            monthly: Math.round(basePremium / 12),
            annual: Math.round(basePremium),
            coverage: data.coverage,
            deductible: data.deductible
        };
    }
    
    updateEstimate() {
        const formData = new FormData(this.form);
        const data = Object.fromEntries(formData.entries());
        const estimate = this.calculateEstimate(data);
        
        // Update the estimate display
        const estimateDisplay = this.form.querySelector('.estimate-display');
        if (estimateDisplay) {
            estimateDisplay.textContent = `Estimated Monthly Premium: $${estimate.monthly}`;
        }
    }
    
    displayResult(estimate) {
        if (!this.resultContainer) return;
        
        this.resultContainer.innerHTML = `
            <div class="calculator-result-content">
                <h3>Your Insurance Estimate</h3>
                <div class="estimate-details">
                    <p><strong>Monthly Premium:</strong> $${estimate.monthly}</p>
                    <p><strong>Annual Premium:</strong> $${estimate.annual}</p>
                    <p><strong>Coverage Amount:</strong> $${estimate.coverage}</p>
                    <p><strong>Deductible:</strong> $${estimate.deductible}</p>
                </div>
                <div class="estimate-actions">
                    <button class="btn-primary" onclick="window.location.href='/contact'">Get a Quote</button>
                    <button class="btn-secondary" onclick="this.closest('.calculator-result').style.display='none'">Close</button>
                </div>
            </div>
        `;
        
        this.resultContainer.style.display = 'block';
    }
}

// Initialize calculator when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new InsuranceCalculator();
}); 