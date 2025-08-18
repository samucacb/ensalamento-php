<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações - Sistema de Ensalamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-building"></i> Sistema de Ensalamento
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="salas.php">
                            <i class="bi bi-door-open"></i> Salas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="turmas.php">
                            <i class="bi bi-people"></i> Turmas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ensalamento.php">
                            <i class="bi bi-calendar-check"></i> Ensalamento
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="relatorios.php">
                            <i class="bi bi-graph-up"></i> Relatórios
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="configuracoes.php">
                            <i class="bi bi-gear"></i> Configurações
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3 mb-0">Configurações do Sistema</h1>
                <p class="text-muted">Gerencie as configurações e parâmetros do sistema</p>
            </div>
        </div>

        <div class="row">
            <!-- Menu Lateral -->
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#geral" class="list-group-item list-group-item-action active" data-bs-toggle="pill">
                        <i class="bi bi-gear me-2"></i> Geral
                    </a>
                    <a href="#algoritmos" class="list-group-item list-group-item-action" data-bs-toggle="pill">
                        <i class="bi bi-cpu me-2"></i> Algoritmos
                    </a>
                    <a href="#backup" class="list-group-item list-group-item-action" data-bs-toggle="pill">
                        <i class="bi bi-shield-check me-2"></i> Backup
                    </a>
                    <a href="#usuarios" class="list-group-item list-group-item-action" data-bs-toggle="pill">
                        <i class="bi bi-people me-2"></i> Usuários
                    </a>
                    <a href="#sistema" class="list-group-item list-group-item-action" data-bs-toggle="pill">
                        <i class="bi bi-info-circle me-2"></i> Sistema
                    </a>
                </div>
            </div>

            <!-- Conteúdo -->
            <div class="col-md-9">
                <div class="tab-content">
                    <!-- Configurações Gerais -->
                    <div class="tab-pane fade show active" id="geral">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Configurações Gerais</h5>
                            </div>
                            


                            <div class="card shadow-sm mb-4">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="bi bi-calendar-plus me-2"></i>Gerenciamento de Períodos Letivos
        </h5>
    </div>
    <div class="card-body">
        <p class="card-text">
            Crie ou remova períodos letivos. Um novo período criado aqui ficará disponível em todo o sistema, como nos filtros das páginas de Turmas e Relatórios.
        </p>

        <!-- Formulário de Criação -->
        <div class="row g-3 align-items-center mb-4">
            <div class="col-auto">
                <label for="input-novo-periodo" class="col-form-label">Novo Período:</label>
            </div>
            <div class="col-auto">
                <input type="text" id="input-novo-periodo" class="form-control" placeholder="Ex: 2026.1" pattern="\d{4}\.[1-2]{1}" title="O formato deve ser ANO.SEMESTRE, como 2025.1 ou 2025.2">
            </div>
            <div class="col-auto">
                <button type="button" id="btn-criar-periodo" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Criar Período
                </button>
            </div>
        </div>

        <!-- Divisor -->
        <hr>

        <!-- Tabela de Períodos Existentes -->
        <h6 class="mt-4">Períodos Existentes</h6>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Período</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody id="tabela-periodos-body">
                    <!-- O conteúdo desta tabela será preenchido dinamicamente via JavaScript -->
                    <tr>
                        <td colspan="2" class="text-center text-muted">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Carregando...</span>
                            </div>
                            Carregando períodos...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>




                            <div class="card-body">
                                <form id="formGeral">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="periodo-atual" class="form-label">Período Letivo Atual</label>
                                                <select class="form-select" id="periodo-atual" name="periodo_atual">
                                                    <option value="2025.1">2025.1</option>
                                                    <option value="2025.2">2025.2</option>
                                                    <option value="2024.2">2024.2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="algoritmo-padrao" class="form-label">Algoritmo Padrão</label>
                                                <select class="form-select" id="algoritmo-padrao" name="algoritmo_padrao">
                                                    <option value="guloso">Guloso</option>
                                                    <option value="otimizado">Otimizado</option>
                                                    <option value="hibrido">Híbrido</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="max-tentativas" class="form-label">Máximo de Tentativas</label>
                                                <input type="number" class="form-control" id="max-tentativas" name="max_tentativas_ensalamento" min="1" max="10" value="3">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="timeout-ensalamento" class="form-label">Timeout Ensalamento (segundos)</label>
                                                <input type="number" class="form-control" id="timeout-ensalamento" name="timeout_ensalamento" min="60" max="1800" value="300">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="backup-automatico" name="backup_automatico">
                                                <label class="form-check-label" for="backup-automatico">
                                                    Backup Automático
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="logs-detalhados" name="logs_detalhados">
                                                <label class="form-check-label" for="logs-detalhados">
                                                    Logs Detalhados
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="button" class="btn btn-primary" onclick="salvarConfiguracoes('geral')">
                                        <i class="bi bi-save"></i> Salvar Configurações
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Configurações de Algoritmos -->
                    <div class="tab-pane fade" id="algoritmos">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Configurações de Algoritmos</h5>
                            </div>
                            <div class="card-body">
                                <form id="formAlgoritmos">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6>Algoritmo Guloso</h6>
                                            <div class="mb-3">
                                                <label for="guloso-peso-capacidade" class="form-label">Peso Capacidade</label>
                                                <input type="range" class="form-range" id="guloso-peso-capacidade" name="guloso_peso_capacidade" min="0" max="100" value="40">
                                                <div class="form-text">Valor: <span id="guloso-peso-capacidade-valor">40</span>%</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="guloso-peso-tipo" class="form-label">Peso Tipo</label>
                                                <input type="range" class="form-range" id="guloso-peso-tipo" name="guloso_peso_tipo" min="0" max="100" value="60">
                                                <div class="form-text">Valor: <span id="guloso-peso-tipo-valor">60</span>%</div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <h6>Algoritmo Otimizado</h6>
                                            <div class="mb-3">
                                                <label for="otimizado-iteracoes" class="form-label">Máximo de Iterações</label>
                                                <input type="number" class="form-control" id="otimizado-iteracoes" name="otimizado_max_iteracoes" min="100" max="10000" value="1000">
                                            </div>
                                            <div class="mb-3">
                                                <label for="otimizado-precisao" class="form-label">Precisão (%)</label>
                                                <input type="number" class="form-control" id="otimizado-precisao" name="otimizado_precisao" min="90" max="100" step="0.1" value="95.0">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <h6>Algoritmo Híbrido</h6>
                                            <div class="mb-3">
                                                <label for="hibrido-fase1" class="form-label">Duração Fase 1 (%)</label>
                                                <input type="range" class="form-range" id="hibrido-fase1" name="hibrido_duracao_fase1" min="10" max="90" value="30">
                                                <div class="form-text">Valor: <span id="hibrido-fase1-valor">30</span>%</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="hibrido-criterio" class="form-label">Critério de Troca</label>
                                                <select class="form-select" id="hibrido-criterio" name="hibrido_criterio_troca">
                                                    <option value="tempo">Tempo</option>
                                                    <option value="qualidade">Qualidade</option>
                                                    <option value="hibrido">Híbrido</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="alert alert-info">
                                        <h6>Dicas de Configuração:</h6>
                                        <ul class="mb-0">
                                            <li><strong>Guloso:</strong> Aumente o peso do tipo para priorizar compatibilidade sala-aula</li>
                                            <li><strong>Otimizado:</strong> Mais iterações = melhor resultado, mas maior tempo</li>
                                            <li><strong>Híbrido:</strong> Fase 1 menor = mais tempo no algoritmo otimizado</li>
                                        </ul>
                                    </div>
                                    
                                    <button type="button" class="btn btn-primary" onclick="salvarConfiguracoes('algoritmos')">
                                        <i class="bi bi-save"></i> Salvar Configurações
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary" onclick="restaurarPadroes('algoritmos')">
                                        <i class="bi bi-arrow-clockwise"></i> Restaurar Padrões
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Configurações de Backup -->
                    <div class="tab-pane fade" id="backup">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Configurações de Backup</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Backup Automático</h6>
                                        <form id="formBackup">
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="backup-ativo" name="backup_ativo">
                                                    <label class="form-check-label" for="backup-ativo">
                                                        Ativar backup automático
                                                    </label>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="backup-frequencia" class="form-label">Frequência</label>
                                                <select class="form-select" id="backup-frequencia" name="backup_frequencia">
                                                    <option value="diario">Diário</option>
                                                    <option value="semanal">Semanal</option>
                                                    <option value="mensal">Mensal</option>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="backup-horario" class="form-label">Horário</label>
                                                <input type="time" class="form-control" id="backup-horario" name="backup_horario" value="02:00">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="backup-retencao" class="form-label">Retenção (dias)</label>
                                                <input type="number" class="form-control" id="backup-retencao" name="backup_retencao" min="1" max="365" value="30">
                                            </div>
                                            
                                            <button type="button" class="btn btn-primary" onclick="salvarConfiguracoes('backup')">
                                                <i class="bi bi-save"></i> Salvar
                                            </button>
                                        </form>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <h6>Backup Manual</h6>
                                        <p class="text-muted">Execute backup imediato dos dados do sistema</p>
                                        
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-outline-primary" onclick="executarBackup('completo')">
                                                <i class="bi bi-download"></i> Backup Completo
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary" onclick="executarBackup('dados')">
                                                <i class="bi bi-database"></i> Apenas Dados
                                            </button>
                                            <button type="button" class="btn btn-outline-info" onclick="executarBackup('configuracoes')">
                                                <i class="bi bi-gear"></i> Apenas Configurações
                                            </button>
                                        </div>
                                        
                                        <hr>
                                        
                                        <h6>Restaurar Backup</h6>
                                        <div class="mb-3">
                                            <input type="file" class="form-control" id="arquivo-backup" accept=".sql,.zip">
                                        </div>
                                        <button type="button" class="btn btn-warning" onclick="restaurarBackup()">
                                            <i class="bi bi-upload"></i> Restaurar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Configurações de Usuários -->
                    <div class="tab-pane fade" id="usuarios">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Usuários do Sistema</h5>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="novoUsuario()">
                                        <i class="bi bi-plus-circle"></i> Novo Usuário
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Usuário</th>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Tipo</th>
                                                <th>Status</th>
                                                <th>Último Acesso</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabela-usuarios">
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    <div class="spinner-border text-primary" role="status">
                                                        <span class="visually-hidden">Carregando...</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informações do Sistema -->
                    <div class="tab-pane fade" id="sistema">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Informações do Sistema</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Sistema</h6>
                                        <table class="table table-sm">
                                            <tr>
                                                <td><strong>Versão:</strong></td>
                                                <td>1.0.0</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Instalado em:</strong></td>
                                                <td id="data-instalacao">-</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Última atualização:</strong></td>
                                                <td id="ultima-atualizacao">-</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Banco de dados:</strong></td>
                                                <td id="versao-banco">-</td>
                                            </tr>
                                        </table>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <h6>Estatísticas</h6>
                                        <table class="table table-sm">
                                            <tr>
                                                <td><strong>Total de salas:</strong></td>
                                                <td id="total-salas-sistema">-</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total de turmas:</strong></td>
                                                <td id="total-turmas-sistema">-</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Ensalamentos executados:</strong></td>
                                                <td id="total-ensalamentos">-</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tamanho do banco:</strong></td>
                                                <td id="tamanho-banco">-</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Manutenção</h6>
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-outline-primary" onclick="otimizarBanco()">
                                                <i class="bi bi-speedometer2"></i> Otimizar Banco
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary" onclick="limparLogs()">
                                                <i class="bi bi-trash"></i> Limpar Logs Antigos
                                            </button>
                                            <button type="button" class="btn btn-outline-warning" onclick="verificarIntegridade()">
                                                <i class="bi bi-shield-check"></i> Verificar Integridade
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <h6>Suporte</h6>
                                        <p class="text-muted">Para suporte técnico, entre em contato:</p>
                                        <ul class="list-unstyled">
                                            <li><i class="bi bi-envelope me-2"></i> suporte@sistema.local</li>
                                            <li><i class="bi bi-telephone me-2"></i> (11) 1234-5678</li>
                                            <li><i class="bi bi-globe me-2"></i> www.sistema.local</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            carregarConfiguracoes();
            carregarUsuarios();
            carregarInformacoesSistema();
            configurarEventos();
        });

        function configurarEventos() {
            // Atualizar valores dos ranges em tempo real
            document.getElementById('guloso-peso-capacidade').addEventListener('input', function() {
                document.getElementById('guloso-peso-capacidade-valor').textContent = this.value;
            });
            
            document.getElementById('guloso-peso-tipo').addEventListener('input', function() {
                document.getElementById('guloso-peso-tipo-valor').textContent = this.value;
            });
            
            document.getElementById('hibrido-fase1').addEventListener('input', function() {
                document.getElementById('hibrido-fase1-valor').textContent = this.value;
            });
        }

        function carregarConfiguracoes() {
            fetch('api/configuracoes.php?action=listar')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        preencherConfiguracoes(data.data);
                    }
                })
                .catch(error => {
                    console.error('Erro ao carregar configurações:', error);
                });
        }

        function preencherConfiguracoes(configs) {
            configs.forEach(config => {
                const elemento = document.querySelector(`[name="${config.chave}"]`);
                if (elemento) {
                    if (elemento.type === 'checkbox') {
                        elemento.checked = config.valor === '1';
                    } else {
                        elemento.value = config.valor;
                    }
                    
                    // Atualizar displays de ranges
                    if (elemento.type === 'range') {
                        const display = document.getElementById(elemento.id + '-valor');
                        if (display) {
                            display.textContent = config.valor;
                        }
                    }
                }
            });
        }

        function salvarConfiguracoes(secao) {
            const form = document.getElementById('form' + secao.charAt(0).toUpperCase() + secao.slice(1));
            const formData = new FormData(form);
            
            // Converter FormData para objeto JSON
            const configuracoes = [];
            
            // Processar todos os campos do formulário
            for (let [name, value] of formData.entries()) {
                // Converter checkboxes para valores numéricos
                if (form.querySelector(`input[name="${name}"][type="checkbox"]`)) {
                    value = form.querySelector(`input[name="${name}"]`).checked ? '1' : '0';
                }
                
                configuracoes.push({
                    chave: name,
                    valor: value,
                    categoria: secao
                });
            }
            
            // Salvar cada configuração individualmente
            Promise.all(configuracoes.map(config => {
                return fetch('api/configuracoes.php?action=salvar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(config)
                }).then(response => response.json());
            }))
            .then(results => {
                const errors = results.filter(result => !result.success);
                if (errors.length === 0) {
                    mostrarSucesso('Configurações salvas com sucesso!');
                } else {
                    mostrarErro('Erro ao salvar algumas configurações: ' + errors[0].message);
                }
            })
            .catch(error => {
                mostrarErro('Erro na comunicação: ' + error.message);
            });
        }

        function restaurarPadroes(secao) {
            if (confirm('Tem certeza que deseja restaurar as configurações padrão?')) {
                fetch(`api/configuracoes.php?action=restaurar&secao=${secao}`, {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        carregarConfiguracoes();
                        mostrarSucesso('Configurações padrão restauradas!');
                    } else {
                        mostrarErro('Erro ao restaurar configurações: ' + data.message);
                    }
                })
                .catch(error => {
                    mostrarErro('Erro na comunicação: ' + error.message);
                });
            }
        }

        function executarBackup(tipo) {
            window.open(`backup.php?tipo=${tipo}`, '_blank');
        }

        function restaurarBackup() {
            const arquivo = document.getElementById('arquivo-backup').files[0];
            if (!arquivo) {
                alert('Selecione um arquivo de backup');
                return;
            }
            
            if (confirm('Tem certeza que deseja restaurar o backup? Todos os dados atuais serão substituídos.')) {
                const formData = new FormData();
                formData.append('arquivo', arquivo);
                
                fetch('backup.php?action=restaurar', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        mostrarSucesso('Backup restaurado com sucesso!');
                    } else {
                        mostrarErro('Erro ao restaurar backup: ' + data.message);
                    }
                })
                .catch(error => {
                    mostrarErro('Erro na comunicação: ' + error.message);
                });
            }
        }

        function carregarUsuarios() {
            fetch('api/usuarios.php?action=listar')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        exibirUsuarios(data.data);
                    }
                })
                .catch(error => {
                    console.error('Erro ao carregar usuários:', error);
                });
        }

        function exibirUsuarios(usuarios) {
            const tbody = document.getElementById('tabela-usuarios');
            
            if (usuarios.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" class="text-center text-muted">Nenhum usuário encontrado</td></tr>';
                return;
            }
            
            let html = '';
            usuarios.forEach(usuario => {
                const statusBadge = usuario.ativo == 1 ? 
                    '<span class="badge bg-success">Ativo</span>' : 
                    '<span class="badge bg-secondary">Inativo</span>';
                
                const tipoBadge = usuario.tipo === 'admin' ? 
                    '<span class="badge bg-danger">Admin</span>' : 
                    '<span class="badge bg-primary">Usuário</span>';
                
                html += `
                    <tr>
                        <td><strong>${usuario.username}</strong></td>
                        <td>${usuario.nome}</td>
                        <td>${usuario.email}</td>
                        <td>${tipoBadge}</td>
                        <td>${statusBadge}</td>
                        <td>${usuario.ultimo_acesso || 'Nunca'}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-outline-primary" onclick="editarUsuario(${usuario.id})">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger" onclick="excluirUsuario(${usuario.id})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });
            
            tbody.innerHTML = html;
        }

        function carregarInformacoesSistema() {
            fetch('api/sistema.php?action=info')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const info = data.data;
                        document.getElementById('data-instalacao').textContent = info.data_instalacao || '-';
                        document.getElementById('ultima-atualizacao').textContent = info.ultima_atualizacao || '-';
                        document.getElementById('versao-banco').textContent = info.versao_banco || '-';
                        document.getElementById('total-salas-sistema').textContent = info.total_salas || '-';
                        document.getElementById('total-turmas-sistema').textContent = info.total_turmas || '-';
                        document.getElementById('total-ensalamentos').textContent = info.total_ensalamentos || '-';
                        document.getElementById('tamanho-banco').textContent = info.tamanho_banco || '-';
                    }
                })
                .catch(error => {
                    console.error('Erro ao carregar informações do sistema:', error);
                });
        }

        function novoUsuario() {
            // Implementar modal de novo usuário
            alert('Funcionalidade em desenvolvimento');
        }

        function editarUsuario(id) {
            // Implementar modal de edição de usuário
            alert('Funcionalidade em desenvolvimento');
        }

        function excluirUsuario(id) {
            if (confirm('Tem certeza que deseja excluir este usuário?')) {
                // Implementar exclusão de usuário
                alert('Funcionalidade em desenvolvimento');
            }
        }

        function otimizarBanco() {
            if (confirm('Deseja otimizar o banco de dados? Esta operação pode demorar alguns minutos.')) {
                fetch('api/sistema.php?action=otimizar', { method: 'POST' })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            mostrarSucesso('Banco de dados otimizado com sucesso!');
                        } else {
                            mostrarErro('Erro ao otimizar banco: ' + data.message);
                        }
                    })
                    .catch(error => {
                        mostrarErro('Erro na comunicação: ' + error.message);
                    });
            }
        }

        function limparLogs() {
            if (confirm('Deseja limpar logs antigos (mais de 90 dias)?')) {
                fetch('api/sistema.php?action=limpar_logs', { method: 'POST' })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            mostrarSucesso('Logs antigos removidos com sucesso!');
                        } else {
                            mostrarErro('Erro ao limpar logs: ' + data.message);
                        }
                    })
                    .catch(error => {
                        mostrarErro('Erro na comunicação: ' + error.message);
                    });
            }
        }

        function verificarIntegridade() {
            fetch('api/sistema.php?action=verificar_integridade', { method: 'POST' })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        mostrarSucesso('Verificação concluída: ' + data.message);
                    } else {
                        mostrarErro('Problemas encontrados: ' + data.message);
                    }
                })
                .catch(error => {
                    mostrarErro('Erro na comunicação: ' + error.message);
                });
        }

        function mostrarSucesso(mensagem) {
            console.log('Sucesso:', mensagem);
            alert(mensagem);
        }

        function mostrarErro(mensagem) {
            console.error('Erro:', mensagem);
            alert(mensagem);
        }


// Coloque todo este código dentro de UMA ÚNICA tag <script>
// no final do seu arquivo configuracoes.php, antes de </body>

// ==========================================================
// 1. DEFINIÇÃO DAS FUNÇÕES
// (Definimos todas as nossas ferramentas primeiro)
// ==========================================================

/**
 * Busca a lista de períodos na API e preenche a tabela.
 */
function carregarPeriodos() {
    const tbody = document.getElementById('tabela-periodos-body');
    tbody.innerHTML = `<tr><td colspan="2" class="text-center text-muted"><div class="spinner-border spinner-border-sm" role="status"></div> Carregando...</td></tr>`;

    fetch('api/configuracoes.php?action=listar_periodos')
        .then(response => response.json())
        .then(data => {
            tbody.innerHTML = ''; // Limpa a tabela
            if (data.success && data.data.length > 0) {
                data.data.forEach(periodo => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td><strong>${periodo}</strong></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-danger" onclick="excluirPeriodo('${periodo}')">
                                <i class="bi bi-trash"></i> Excluir
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            } else {
                tbody.innerHTML = '<tr><td colspan="2" class="text-center text-muted">Nenhum período cadastrado.</td></tr>';
            }
        })
        .catch(error => {
            tbody.innerHTML = `<tr><td colspan="2" class="text-center text-danger">Erro de comunicação.</td></tr>`;
        });
}

/**
 * Envia a requisição para criar um novo período.
 */
function criarPeriodo() {
    const input = document.getElementById('input-novo-periodo');
    const novoPeriodo = input.value.trim();

    if (!/^\d{4}\.[1-2]$/.test(novoPeriodo)) {
        alert('Formato do período inválido. Use o formato ANO.SEMESTRE (ex: 2025.1).');
        return;
    }

    const botao = document.getElementById('btn-criar-periodo');
    const textoOriginalBotao = botao.innerHTML;
    botao.disabled = true;
    botao.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Criando...';

    fetch('api/configuracoes.php?action=criar_periodo', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ periodo: novoPeriodo })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            input.value = '';
            carregarPeriodos(); // Agora esta chamada funciona, pois a função já foi definida.
        } else {
            alert('Erro: ' + data.message);
        }
    })
    .catch(error => alert('Erro de comunicação ao criar período.'))
    .finally(() => {
        botao.disabled = false;
        botao.innerHTML = textoOriginalBotao;
    });
}

// VERSÃO NOVA E FUNCIONAL
function excluirPeriodo(periodo) {
    // Pede uma confirmação ao usuário antes de realizar uma ação destrutiva
    if (!confirm(`Você tem certeza que deseja excluir o período "${periodo}"?\n\nEsta ação não poderá ser desfeita.`)) {
        return; // Se o usuário clicar em "Cancelar", a função para aqui.
    }

    // Envia a requisição para a API usando o método POST
    fetch('api/configuracoes.php?action=excluir_periodo', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ periodo: periodo }) // Envia o período a ser excluído
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message); // Mostra a mensagem de sucesso
            carregarPeriodos(); // Recarrega a lista de períodos para remover o que foi excluído
        } else {
            // Se a API retornou um erro (ex: período tem turmas associadas)
            alert('Erro ao excluir período: ' + data.message);
        }
    })
    .catch(error => {
        alert('Ocorreu um erro de comunicação com o servidor.');
        console.error('Erro no fetch:', error);
    });
}



// ==========================================================
// 2. EXECUÇÃO E EVENTOS
// (Agora que as funções existem, nós as usamos)
// ==========================================================

document.addEventListener('DOMContentLoaded', function() {
    // 1. Carrega a lista inicial de períodos
    carregarPeriodos();

    // 2. Adiciona o evento de clique ao botão "Criar"
    document.getElementById('btn-criar-periodo').addEventListener('click', criarPeriodo);

    // 3. Adiciona o evento de "Enter" ao campo de input
    document.getElementById('input-novo-periodo').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            criarPeriodo();
        }
    });
});



    </script>
</body>
</html>

