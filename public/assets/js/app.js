// JavaScript pour l'interface Flight Login MVC

// Fonction utilitaire pour les requêtes AJAX
async function apiCall(url, method = 'GET', data = null) {
    const options = {
        method: method,
        headers: {
            'Content-Type': 'application/json'
        }
    };
    if (data) {
        options.body = JSON.stringify(data);
    }
    
    try {
        const response = await fetch(url, options);
        const text = await response.text();
        
        try {
            return JSON.parse(text);
        } catch (e) {
            return { error: 'Erreur de format JSON', details: text.substring(0, 200) };
        }
    } catch (error) {
        return { error: 'Erreur de connexion', details: error.message };
    }
}

// Gestion du loading sur les boutons
function setButtonLoading(button, loading = true) {
    if (loading) {
        button.disabled = true;
        button.dataset.originalText = button.textContent;
        button.textContent = 'Chargement...';
    } else {
        button.disabled = false;
        button.textContent = button.dataset.originalText || button.textContent;
    }
}

// Test ping
async function testPing() {
    const button = event.target;
    setButtonLoading(button, true);
    
    try {
        const result = await apiCall('ping');
        showResponse('pingResponse', result, result.error ? 'error' : 'success');
    } catch (error) {
        showResponse('pingResponse', {error: error.message}, 'error');
    } finally {
        setButtonLoading(button, false);
    }
}

// Validation simple
function validateForm(data) {
    const errors = [];
    
    if (data.name && data.name.length < 2) {
        errors.push('Le nom doit contenir au moins 2 caractères');
    }
    
    if (data.email && !data.email.includes('@')) {
        errors.push('L\'adresse email n\'est pas valide');
    }
    
    if (data.password && data.password.length < 6) {
        errors.push('Le mot de passe doit contenir au moins 6 caractères');
    }
    
    return errors;
}

// Enregistrement
document.getElementById('registerForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const button = e.target.querySelector('button[type="submit"]');
    setButtonLoading(button, true);
    
    const data = {
        name: document.getElementById('regName').value.trim(),
        email: document.getElementById('regEmail').value.trim(),
        password: document.getElementById('regPassword').value
    };

    const validationErrors = validateForm(data);
    if (validationErrors.length > 0) {
        showResponse('registerResponse', {
            error: 'Erreurs de validation',
            details: validationErrors
        }, 'error');
        setButtonLoading(button, false);
        return;
    }

    try {
        const result = await apiCall('register', 'POST', data);
        showResponse('registerResponse', result, result.success ? 'success' : 'error');
        if (result.success) {
            document.getElementById('registerForm').reset();
        }
    } catch (error) {
        showResponse('registerResponse', {error: error.message}, 'error');
    } finally {
        setButtonLoading(button, false);
    }
});

// Connexion
document.getElementById('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const button = e.target.querySelector('button[type="submit"]');
    setButtonLoading(button, true);
    
    const data = {
        email: document.getElementById('loginEmail').value.trim(),
        password: document.getElementById('loginPassword').value
    };

    if (!data.email || !data.password) {
        showResponse('loginResponse', {
            error: 'Veuillez remplir tous les champs'
        }, 'error');
        setButtonLoading(button, false);
        return;
    }

    try {
        const result = await apiCall('login', 'POST', data);
        showResponse('loginResponse', result, result.success ? 'success' : 'error');
        if (result.success) {
            document.getElementById('loginForm').reset();
        }
    } catch (error) {
        showResponse('loginResponse', {error: error.message}, 'error');
    } finally {
        setButtonLoading(button, false);
    }
});

// Afficher la réponse
function showResponse(elementId, data, type) {
    const element = document.getElementById(elementId);
    
    let formattedData;
    if (typeof data === 'object') {
        formattedData = JSON.stringify(data, null, 2);
    } else {
        formattedData = data;
    }
    
    element.innerHTML = formattedData;
    element.className = 'response ' + type;
    element.style.display = 'block';
}