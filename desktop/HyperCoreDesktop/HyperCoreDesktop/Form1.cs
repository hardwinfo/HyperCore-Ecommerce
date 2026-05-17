using MySql.Data.MySqlClient;
using System.Data;
using System.IO;
using System.Text;

namespace HyperCoreDesktop
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        /*
        |--------------------------------------------------------------------------
        | CARREGAR PRODUTOS
        |--------------------------------------------------------------------------
        */

        public void CarregarProdutos()
        {
            try
            {
                Database db = new Database();

                MySqlConnection conn = db.GetConnection();

                conn.Open();

                string sql =
                    "SELECT id, nome, preco, estoque FROM produtos";

                MySqlDataAdapter adapter =
                    new MySqlDataAdapter(sql, conn);

                DataTable table = new DataTable();

                adapter.Fill(table);

                dgvProdutos.DataSource = table;

                conn.Close();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CARREGAR PEDIDOS
        |--------------------------------------------------------------------------
        */

        public void CarregarPedidos()
        {
            try
            {
                Database db = new Database();

                MySqlConnection conn = db.GetConnection();

                conn.Open();

                string sql = @"
                SELECT
                    pedidos.id,
                    clientes.nome AS cliente,
                    pedidos.total,
                    pedidos.status,
                    pedidos.criado_em
                FROM pedidos
                INNER JOIN clientes
                    ON pedidos.cliente_id = clientes.id
                ORDER BY pedidos.id DESC";

                MySqlDataAdapter adapter =
                    new MySqlDataAdapter(sql, conn);

                DataTable table = new DataTable();

                adapter.Fill(table);

                dgvPedidos.DataSource = table;

                conn.Close();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }
        public void CarregarCategorias()
        {
            try
            {
                Database db = new Database();

                MySqlConnection conn =
                    db.GetConnection();

                conn.Open();

                string sql =
                    "SELECT id, nome FROM categorias";

                MySqlDataAdapter adapter =
                    new MySqlDataAdapter(sql, conn);

                DataTable table =
                    new DataTable();

                adapter.Fill(table);

                dgvCategorias.DataSource = table;

                conn.Close();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | LOAD FORM
        |--------------------------------------------------------------------------
        */

        private void Form1_Load(object sender, EventArgs e)
        {
            CarregarProdutos();

            CarregarPedidos();

            CarregarCategorias();
        }

        /*
        |--------------------------------------------------------------------------
        | CADASTRAR PRODUTO
        |--------------------------------------------------------------------------
        */

        private void btnCadastrar_Click(object sender, EventArgs e)
        {
            try
            {
                Database db = new Database();

                MySqlConnection conn = db.GetConnection();

                conn.Open();

                string sql = @"INSERT INTO produtos
                (nome, preco, estoque, descricao, imagem, categoria_id)
                VALUES
                (@nome, @preco, @estoque, @descricao, '', 1)";

                MySqlCommand cmd =
                    new MySqlCommand(sql, conn);

                cmd.Parameters.AddWithValue(
                    "@nome",
                    txtNome.Text
                );

                cmd.Parameters.AddWithValue(
                    "@preco",
                    Convert.ToDecimal(txtPreco.Text)
                );

                cmd.Parameters.AddWithValue(
                    "@estoque",
                    Convert.ToInt32(txtEstoque.Text)
                );

                cmd.Parameters.AddWithValue(
                    "@descricao",
                    txtDescricao.Text
                );

                cmd.ExecuteNonQuery();

                MessageBox.Show("Produto cadastrado!");

                conn.Close();

                CarregarProdutos();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | EXCLUIR PRODUTO
        |--------------------------------------------------------------------------
        */

        private void btnExcluir_Click(object sender, EventArgs e)
        {
            try
            {
                if (dgvProdutos.CurrentRow != null)
                {
                    int id = Convert.ToInt32(
                        dgvProdutos.CurrentRow.Cells["id"].Value
                    );

                    Database db = new Database();

                    MySqlConnection conn = db.GetConnection();

                    conn.Open();

                    string sql =
                        "DELETE FROM produtos WHERE id = @id";

                    MySqlCommand cmd =
                        new MySqlCommand(sql, conn);

                    cmd.Parameters.AddWithValue("@id", id);

                    cmd.ExecuteNonQuery();

                    MessageBox.Show("Produto excluído!");

                    conn.Close();

                    CarregarProdutos();
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CLICAR NA GRID
        |--------------------------------------------------------------------------
        */

        private void dgvProdutos_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            try
            {
                txtNome.Text =
                    dgvProdutos.CurrentRow.Cells["nome"].Value.ToString();

                txtPreco.Text =
                    dgvProdutos.CurrentRow.Cells["preco"].Value.ToString();

                txtEstoque.Text =
                    dgvProdutos.CurrentRow.Cells["estoque"].Value.ToString();

                int id = Convert.ToInt32(
                    dgvProdutos.CurrentRow.Cells["id"].Value
                );

                Database db = new Database();

                MySqlConnection conn = db.GetConnection();

                conn.Open();

                string sql =
                    "SELECT descricao FROM produtos WHERE id = @id";

                MySqlCommand cmd =
                    new MySqlCommand(sql, conn);

                cmd.Parameters.AddWithValue("@id", id);

                MySqlDataReader reader = cmd.ExecuteReader();

                if (reader.Read())
                {
                    txtDescricao.Text =
                        reader["descricao"].ToString();
                }

                conn.Close();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | ATUALIZAR PRODUTO
        |--------------------------------------------------------------------------
        */

        private void btnAtualizar_Click(object sender, EventArgs e)
        {
            try
            {
                int id = Convert.ToInt32(
                    dgvProdutos.CurrentRow.Cells["id"].Value
                );

                Database db = new Database();

                MySqlConnection conn = db.GetConnection();

                conn.Open();

                string sql = @"UPDATE produtos
                SET
                    nome = @nome,
                    preco = @preco,
                    estoque = @estoque,
                    descricao = @descricao
                WHERE id = @id";

                MySqlCommand cmd =
                    new MySqlCommand(sql, conn);

                cmd.Parameters.AddWithValue(
                    "@nome",
                    txtNome.Text
                );

                cmd.Parameters.AddWithValue(
                    "@preco",
                    Convert.ToDecimal(txtPreco.Text)
                );

                cmd.Parameters.AddWithValue(
                    "@estoque",
                    Convert.ToInt32(txtEstoque.Text)
                );

                cmd.Parameters.AddWithValue(
                    "@descricao",
                    txtDescricao.Text
                );

                cmd.Parameters.AddWithValue(
                    "@id",
                    id
                );

                cmd.ExecuteNonQuery();

                MessageBox.Show("Produto atualizado!");

                conn.Close();

                CarregarProdutos();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        private void btnAvancarPedido_Click(object sender, EventArgs e)
        {
            try
            {
                if (dgvPedidos.CurrentRow != null)
                {
                    int id = Convert.ToInt32(
                        dgvPedidos.CurrentRow.Cells["id"].Value
                    );

                    string statusAtual =
                        dgvPedidos.CurrentRow.Cells["status"]
                        .Value.ToString();

                    string novoStatus = "";

                    if (statusAtual == "NOVO")
                    {
                        novoStatus = "PROCESSANDO";
                    }
                    else if (statusAtual == "PROCESSANDO")
                    {
                        novoStatus = "ENVIADO";
                    }
                    else if (statusAtual == "ENVIADO")
                    {
                        novoStatus = "ENTREGUE";
                    }
                    else
                    {
                        MessageBox.Show(
                            "Pedido já foi entregue!"
                        );

                        return;
                    }

                    Database db = new Database();

                    MySqlConnection conn =
                        db.GetConnection();

                    conn.Open();

                    string sql =
                        "UPDATE pedidos SET status = @status WHERE id = @id";

                    MySqlCommand cmd =
                        new MySqlCommand(sql, conn);

                    cmd.Parameters.AddWithValue(
                        "@status",
                        novoStatus
                    );

                    cmd.Parameters.AddWithValue(
                        "@id",
                        id
                    );

                    cmd.ExecuteNonQuery();

                    conn.Close();

                    MessageBox.Show(
                        "Status atualizado para: " + novoStatus
                    );

                    CarregarPedidos();
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        private void btnCSV_Click(object sender, EventArgs e)
        {
            try
            {
                SaveFileDialog salvar =
                    new SaveFileDialog();

                salvar.Filter =
                    "Arquivo CSV (*.csv)|*.csv";

                salvar.FileName =
                    "relatorio_vendas.csv";

                if (salvar.ShowDialog() == DialogResult.OK)
                {
                    StringBuilder csv =
                        new StringBuilder();

                    /*
                    |--------------------------------------------------------------------------
                    | CABEÇALHO
                    |--------------------------------------------------------------------------
                    */

                    csv.AppendLine(
                        "ID,CLIENTE,TOTAL,STATUS,DATA"
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | LINHAS
                    |--------------------------------------------------------------------------
                    */

                    foreach (DataGridViewRow row in dgvPedidos.Rows)
                    {
                        if (!row.IsNewRow)
                        {
                            csv.AppendLine(
                                row.Cells["id"].Value + "," +
                                row.Cells["cliente"].Value + "," +
                                row.Cells["total"].Value + "," +
                                row.Cells["status"].Value + "," +
                                row.Cells["criado_em"].Value
                            );
                        }
                    }

                    File.WriteAllText(
                        salvar.FileName,
                        csv.ToString(),
                        Encoding.UTF8
                    );

                    MessageBox.Show(
                        "CSV exportado com sucesso!"
                    );
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        private void btnCategoria_Click(object sender, EventArgs e)
        {
            try
            {
                Database db = new Database();

                MySqlConnection conn =
                    db.GetConnection();

                conn.Open();

                string sql =
                    "INSERT INTO categorias(nome) VALUES(@nome)";

                MySqlCommand cmd =
                    new MySqlCommand(sql, conn);

                cmd.Parameters.AddWithValue(
                    "@nome",
                    txtCategoria.Text
                );

                cmd.ExecuteNonQuery();

                MessageBox.Show(
                    "Categoria cadastrada!"
                );

                conn.Close();

                CarregarCategorias();

                txtCategoria.Clear();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        private void btnExcluirCategoria_Click(object sender, EventArgs e)
        {
            try
            {
                if (dgvCategorias.CurrentRow != null)
                {
                    int id = Convert.ToInt32(
                        dgvCategorias.CurrentRow.Cells["id"].Value
                    );

                    Database db = new Database();

                    MySqlConnection conn =
                        db.GetConnection();

                    conn.Open();

                    string sql =
                        "DELETE FROM categorias WHERE id = @id";

                    MySqlCommand cmd =
                        new MySqlCommand(sql, conn);

                    cmd.Parameters.AddWithValue(
                        "@id",
                        id
                    );

                    cmd.ExecuteNonQuery();

                    MessageBox.Show(
                        "Categoria excluída!"
                    );

                    conn.Close();

                    CarregarCategorias();
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }
    }
}