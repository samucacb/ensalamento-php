<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salas - Sistema de Ensalamento</title>
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
                        <a class="nav-link active" href="salas.php">
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
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3 mb-0">Gestão de Salas</h1>
                <p class="text-muted">Cadastro e gerenciamento de salas de aula</p>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary" onclick="novaSala()">
                    <i class="bi bi-plus-circle"></i> Nova Sala
                </button>
            </div>
        </div>

        <!-- Filtros -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Buscar</label>
                        <input type="text" class="form-control" id="filtro-busca" placeholder="Código ou nome da sala" onkeyup="filtrarSalas()">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Tipo</label>
                        <select class="form-select" id="filtro-tipo" onchange="filtrarSalas()">
                            <option value="">Todos</option>
                            <option value="comum">Comum</option>
                            <option value="laboratorio">Laboratório</option>
                            <option value="auditorio">Auditório</option>
                            <option value="pratica">Prática</option>
                            <option value="informatica">Informática</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Capacidade</label>
                        <select class="form-select" id="filtro-capacidade" onchange="filtrarSalas()">
                            <option value="">Todas</option>
                            <option value="1-20">1-20 alunos</option>
                            <option value="21-40">21-40 alunos</option>
                            <option value="41-60">41-60 alunos</option>
                            <option value="60+">60+ alunos</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="filtro-status" onchange="filtrarSalas()">
                            <option value="">Todos</option>
                            <option value="1">Ativa</option>
                            <option value="0">Inativa</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary" onclick="limparFiltros()">
                                <i class="bi bi-x-circle"></i> Limpar
                            </button>
                            <button type="button" class="btn btn-outline-primary" onclick="exportarSalas()">
                                <i class="bi bi-download"></i> Exportar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estatísticas -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center">
                        <h3 class="mb-0" id="total-salas">-</h3>
                        <p class="mb-0">Total de Salas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <h3 class="mb-0" id="salas-ativas">-</h3>
                        <p class="mb-0">Salas Ativas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body text-center">
                        <h3 class="mb-0" id="capacidade-total">-</h3>
                        <p class="mb-0">Capacidade Total</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center">
                        <h3 class="mb-0" id="media-capacidade">-</h3>
                        <p class="mb-0">Média por Sala</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabela de Salas -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-table"></i> Lista de Salas
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tabela-salas">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>Capacidade</th>
                                <th>Localização</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-salas">
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

    <!-- Modal Nova/Editar Sala -->
    <div class="modal fade" id="modalSala" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSalaTitle">Nova Sala</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formSala">
                        <input type="hidden" id="sala-id" name="id">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sala-codigo" class="form-label">Código *</label>
                                    <input type="text" class="form-control" id="sala-codigo" name="codigo" required>
                                    <div class="form-text">Código único da sala (ex: A101, LAB01)</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sala-nome" class="form-label">Nome *</label>
                                    <input type="text" class="form-control" id="sala-nome" name="nome" required>
                                    <div class="form-text">Nome descritivo da sala</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sala-tipo" class="form-label">Tipo *</label>
                                    <select class="form-select" id="sala-tipo" name="tipo" required>
                                        <option value="">Selecione o tipo</option>
                                        <option value="comum">Comum</option>
                                        <option value="laboratorio">Laboratório</option>
                                        <option value="auditorio">Auditório</option>
                                        <option value="pratica">Prática</option>
                                        <option value="informatica">Informática</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sala-capacidade" class="form-label">Capacidade *</label>
                                    <input type="number" class="form-control" id="sala-capacidade" name="capacidade" min="1" max="500" required>
                                    <div class="form-text">Número máximo de alunos</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="sala-localizacao" class="form-label">Localização</label>
                            <input type="text" class="form-control" id="sala-localizacao" name="localizacao">
                            <div class="form-text">Descrição da localização (ex: Bloco A - 1º Andar)</div>
                        </div>
                        
<!-- Substitua o <select> de recursos por este campo de texto -->
<div class="mb-3">
    <label for="sala-recursos" class="form-label">Recurso Principal</label>
    <input type="text" class="form-control" id="sala-recursos" name="recursos" placeholder="Ex: Projetor, Ar Condicionado">
    <div class="form-text">Equipamentos e recursos disponíveis, separados por vírgula.</div>
</div>
                   <div class="form-check">
                            <!-- VERSÃO CORRETA -->
<input class="form-check-input" type="checkbox" id="sala-ativa" name="ativo">

                            <label class="form-check-label" for="sala-ativa">
                                Sala ativa
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="salvarSala()">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirmar Exclusão -->
    <div class="modal fade" id="modalExcluir" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir a sala <strong id="sala-excluir-nome"></strong>?</p>
                    <p class="text-muted">Esta ação não pode ser desfeita.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="confirmarExclusao()">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Variáveis globais
        let salas = [];
        let salaParaExcluir = null;
        
        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            carregarSalas();
        });

        const modalSalaElement = document.getElementById('modalSala');
        modalSalaElement.addEventListener('hide.bs.modal', function () {
            if (document.activeElement && modalSalaElement.contains(document.activeElement)) {
                document.activeElement.blur();
            }
        });

// Em salas.php

function carregarSalas() {
    const url = 'api/salas.php?action=listar';

    const cacheBuster = '_=' + new Date().getTime();
    const statusFilter = 'status=';
    // 2. Adiciona o 'cacheBuster' à URL da requisição fetch.
     fetch(`api/salas.php?action=listar&${statusFilter}&${cacheBuster}`)
    // ==========================================================
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // O resto da sua função continua exatamente igual.
                salas = data.data.salas;
                exibirSalas(salas);
                atualizarEstatisticas(salas);
            } else {
                mostrarErro('Erro ao carregar salas: ' + data.message);
            }
        })
        .catch(error => {
            mostrarErro('Erro na comunicação: ' + error.message);
        });
}


        function exibirSalas(listaSalas) {
            const tbody = document.getElementById('tbody-salas');
            
            if (listaSalas.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Nenhuma sala encontrada
                        </td>
                    </tr>
                `;
                return;
            }
            
            let html = '';
            listaSalas.forEach(sala => {
                const statusBadge = (sala.ativo == 1 || sala.ativa == 1) ? 
                    '<span class="badge bg-success">Ativa</span>' : 
                    '<span class="badge bg-secondary">Inativa</span>';
                
                const tipoBadge = getTipoBadge(sala.tipo);
                
                html += `
                    <tr>
                        <td><strong>${sala.codigo}</strong></td>
                        <td>${sala.nome}</td>
                        <td>${tipoBadge}</td>
                        <td class="text-center">${sala.capacidade}</td>
                        <td>${sala.localizacao || '-'}</td>
                        <td>${statusBadge}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-outline-primary" onclick="editarSala(${sala.id})" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-outline-info" onclick="verDetalhes(${sala.id})" title="Detalhes">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger" onclick="excluirSala(${sala.id})" title="Excluir">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });
            
            tbody.innerHTML = html;
        }

        function getTipoBadge(tipo) {
            const badges = {
                'comum': '<span class="badge bg-primary">Comum</span>',
                'laboratorio': '<span class="badge bg-success">Laboratório</span>',
                'auditorio': '<span class="badge bg-warning text-dark">Auditório</span>',
                'pratica': '<span class="badge bg-info">Prática</span>',
                'informatica': '<span class="badge bg-secondary">Informática</span>'
            };
            return badges[tipo] || '<span class="badge bg-light text-dark">' + tipo + '</span>';
        }

        function atualizarEstatisticas(listaSalas) {
            const total = listaSalas.length;
            const ativas = listaSalas.filter(s => s.ativa == 1).length;
            const capacidadeTotal = listaSalas.reduce((sum, s) => sum + parseInt(s.capacidade), 0);
            const mediaCapacidade = total > 0 ? Math.round(capacidadeTotal / total) : 0;
            
            document.getElementById('total-salas').textContent = total;
            document.getElementById('salas-ativas').textContent = ativas;
            document.getElementById('capacidade-total').textContent = capacidadeTotal;
            document.getElementById('media-capacidade').textContent = mediaCapacidade;
        }

        function filtrarSalas() {
            const busca = document.getElementById('filtro-busca').value.toLowerCase();
            const tipo = document.getElementById('filtro-tipo').value;
            const capacidade = document.getElementById('filtro-capacidade').value;
            const status = document.getElementById('filtro-status').value;
            
            let salasFiltradas = salas.filter(sala => {
                // Filtro de busca
                if (busca && !sala.codigo.toLowerCase().includes(busca) && !sala.nome.toLowerCase().includes(busca)) {
                    return false;
                }
                
                // Filtro de tipo
                if (tipo && sala.tipo !== tipo) {
                    return false;
                }
                
                // Filtro de capacidade
                if (capacidade) {
                    const cap = parseInt(sala.capacidade);
                    switch (capacidade) {
                        case '1-20':
                            if (cap < 1 || cap > 20) return false;
                            break;
                        case '21-40':
                            if (cap < 21 || cap > 40) return false;
                            break;
                        case '41-60':
                            if (cap < 41 || cap > 60) return false;
                            break;
                        case '60+':
                            if (cap <= 60) return false;
                            break;
                    }
                }
                
                // Filtro de status
                if (status !== '') {
                    const statusNumerico = parseInt(status);
                    const salaAtiva = parseInt(sala.ativo) || parseInt(sala.ativa) || 0;
                    if (salaAtiva !== statusNumerico) {
                        return false;
                    }
                }
                
                return true;
            });
            
            exibirSalas(salasFiltradas);
            atualizarEstatisticas(salasFiltradas);
        }

        function limparFiltros() {
            document.getElementById('filtro-busca').value = '';
            document.getElementById('filtro-tipo').value = '';
            document.getElementById('filtro-capacidade').value = '';
            document.getElementById('filtro-status').value = '';
            exibirSalas(salas);
            atualizarEstatisticas(salas);
        }

        function novaSala() {
            document.getElementById('modalSalaTitle').textContent = 'Nova Sala';
            document.getElementById('formSala').reset();
            document.getElementById('sala-id').value = '';
            document.getElementById('sala-ativa').checked = true;
            
            const modal = new bootstrap.Modal(document.getElementById('modalSala'));
            modal.show();
        }

        function editarSala(id) { 
            const sala = salas.find(s => s.id == id);
            if (!sala) return;
            console.log('Dados da sala para edição:', sala);
            document.getElementById('modalSalaTitle').textContent = 'Editar Sala';
            document.getElementById('sala-id').value = sala.id;
            document.getElementById('sala-codigo').value = sala.codigo;
            document.getElementById('sala-nome').value = sala.nome;
            document.getElementById('sala-tipo').value = sala.tipo;
            document.getElementById('sala-capacidade').value = sala.capacidade;
            document.getElementById('sala-localizacao').value = sala.localizacao || '';
            document.getElementById('sala-recursos').value = sala.recursos || '';
            document.getElementById('sala-ativa').checked = (sala.ativo == 1);
            
            const modal = new bootstrap.Modal(document.getElementById('modalSala'));
            modal.show();
        }

 // Em salas.php

// Em salas.php

function salvarSala() {
    const form = document.getElementById('formSala');
    const formData = new FormData(form);
    
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    formData.set('ativo', document.getElementById('sala-ativa').checked ? '1' : '0');
    
    const id = document.getElementById('sala-id').value;
    const action = id ? 'atualizar' : 'criar';
    
    const saveButton = document.querySelector('#modalSala .modal-footer .btn-primary');
    saveButton.disabled = true;
    saveButton.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Salvando...';

    fetch(`api/salas.php?action=${action}`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // ==========================================================
            // >> LÓGICA CORRIGIDA E SIMPLIFICADA <<
            // ==========================================================
            // 1. Fecha o modal.
            const modalInstance = bootstrap.Modal.getInstance(document.getElementById('modalSala'));
            if (modalInstance) {
                modalInstance.hide();
            }
            
            // 2. Mostra a mensagem de sucesso.
            mostrarSucesso(data.message || (id ? 'Sala atualizada com sucesso!' : 'Sala criada com sucesso!'));
            
            // 3. CHAMA A FUNÇÃO PARA RECARREGAR OS DADOS DO SERVIDOR.
            //    Isso garante que a tabela e o array 'salas' sejam atualizados.
            carregarSalas();
            // ==========================================================

        } else {
            mostrarErro('Erro ao salvar sala: ' + data.message);
        }
    })
    .catch(error => {
        mostrarErro('Erro na comunicação: ' + error.message);
    })
    .finally(() => {
        saveButton.disabled = false;
        saveButton.innerHTML = 'Salvar';
    });
}


        function excluirSala(id) {
            const sala = salas.find(s => s.id == id);
            if (!sala) return;
            
            salaParaExcluir = id;
            document.getElementById('sala-excluir-nome').textContent = sala.codigo + ' - ' + sala.nome;
            
            const modal = new bootstrap.Modal(document.getElementById('modalExcluir'));
            modal.show();
        }

        function confirmarExclusao() {
            if (!salaParaExcluir) return;
            
            fetch(`api/salas.php?action=excluir&id=${salaParaExcluir}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    bootstrap.Modal.getInstance(document.getElementById('modalExcluir')).hide();
                    carregarSalas();
                    mostrarSucesso('Sala excluída com sucesso!');
                } else {
                    mostrarErro('Erro ao excluir sala: ' + data.message);
                }
            })
            .catch(error => {
                mostrarErro('Erro na comunicação: ' + error.message);
            })
            .finally(() => {
                salaParaExcluir = null;
            });
        }

        function verDetalhes(id) {
            const sala = salas.find(s => s.id == id);
            if (!sala) return;
            
            const detalhes = `
                Código: ${sala.codigo}
                Nome: ${sala.nome}
                Tipo: ${sala.tipo}
                Capacidade: ${sala.capacidade} alunos
                Localização: ${sala.localizacao || 'Não informada'}
                Recursos: ${sala.recursos || 'Não informados'}
                Status: ${sala.ativa == 1 ? 'Ativa' : 'Inativa'}
            `;
            
            alert(detalhes);
        }

        function exportarSalas() {
            window.open('api/salas.php?action=exportar&formato=csv', '_blank');
        }

        function mostrarSucesso(mensagem) {
            // Implementar toast de sucesso
            console.log('Sucesso:', mensagem);
            alert(mensagem);
        }

        function mostrarErro(mensagem) {
            // Implementar toast de erro
            console.error('Erro:', mensagem);
            alert(mensagem);
        }

    </script>
</body>
</html>

