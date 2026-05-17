namespace HyperCoreDesktop
{
    partial class Form1
    {
        /// <summary>
        ///  Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        ///  Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        ///  Required method for Designer support - do not modify
        ///  the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            dgvProdutos = new DataGridView();
            label1 = new Label();
            txtNome = new TextBox();
            label2 = new Label();
            txtPreco = new TextBox();
            label3 = new Label();
            txtEstoque = new TextBox();
            btnCadastrar = new Button();
            label4 = new Label();
            txtDescricao = new TextBox();
            btnExcluir = new Button();
            btnAtualizar = new Button();
            dgvPedidos = new DataGridView();
            btnAvancarPedido = new Button();
            btnCSV = new Button();
            dgvCategorias = new DataGridView();
            btnCategoria = new Button();
            txtCategoria = new TextBox();
            btnExcluirCategoria = new Button();
            ((System.ComponentModel.ISupportInitialize)dgvProdutos).BeginInit();
            ((System.ComponentModel.ISupportInitialize)dgvPedidos).BeginInit();
            ((System.ComponentModel.ISupportInitialize)dgvCategorias).BeginInit();
            SuspendLayout();
            // 
            // dgvProdutos
            // 
            dgvProdutos.ColumnHeadersHeightSizeMode = DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            dgvProdutos.Location = new Point(21, 303);
            dgvProdutos.Name = "dgvProdutos";
            dgvProdutos.Size = new Size(441, 271);
            dgvProdutos.TabIndex = 0;
            dgvProdutos.CellClick += dgvProdutos_CellClick;
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Font = new Font("Segoe UI", 14.25F, FontStyle.Bold, GraphicsUnit.Point, 0);
            label1.Location = new Point(21, 21);
            label1.Name = "label1";
            label1.Size = new Size(66, 25);
            label1.TabIndex = 1;
            label1.Text = "Nome";
            // 
            // txtNome
            // 
            txtNome.Location = new Point(124, 23);
            txtNome.Name = "txtNome";
            txtNome.Size = new Size(200, 23);
            txtNome.TabIndex = 2;
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.Font = new Font("Segoe UI", 14.25F, FontStyle.Bold, GraphicsUnit.Point, 0);
            label2.Location = new Point(21, 67);
            label2.Name = "label2";
            label2.Size = new Size(63, 25);
            label2.TabIndex = 3;
            label2.Text = "Preço";
            // 
            // txtPreco
            // 
            txtPreco.Location = new Point(124, 72);
            txtPreco.Name = "txtPreco";
            txtPreco.Size = new Size(200, 23);
            txtPreco.TabIndex = 4;
            // 
            // label3
            // 
            label3.AutoSize = true;
            label3.Font = new Font("Segoe UI", 14.25F, FontStyle.Bold, GraphicsUnit.Point, 0);
            label3.Location = new Point(21, 117);
            label3.Name = "label3";
            label3.Size = new Size(83, 25);
            label3.TabIndex = 5;
            label3.Text = "Estoque";
            // 
            // txtEstoque
            // 
            txtEstoque.Location = new Point(124, 122);
            txtEstoque.Name = "txtEstoque";
            txtEstoque.Size = new Size(200, 23);
            txtEstoque.TabIndex = 6;
            // 
            // btnCadastrar
            // 
            btnCadastrar.Font = new Font("Segoe UI", 14.25F, FontStyle.Bold, GraphicsUnit.Point, 0);
            btnCadastrar.Location = new Point(492, 303);
            btnCadastrar.Name = "btnCadastrar";
            btnCadastrar.Size = new Size(186, 38);
            btnCadastrar.TabIndex = 7;
            btnCadastrar.Text = "Cadastrar Produto";
            btnCadastrar.UseVisualStyleBackColor = true;
            btnCadastrar.Click += btnCadastrar_Click;
            // 
            // label4
            // 
            label4.AutoSize = true;
            label4.Font = new Font("Segoe UI", 14.25F, FontStyle.Bold, GraphicsUnit.Point, 0);
            label4.Location = new Point(21, 165);
            label4.Name = "label4";
            label4.Size = new Size(97, 25);
            label4.TabIndex = 8;
            label4.Text = "Descrição";
            // 
            // txtDescricao
            // 
            txtDescricao.Location = new Point(124, 170);
            txtDescricao.Multiline = true;
            txtDescricao.Name = "txtDescricao";
            txtDescricao.Size = new Size(433, 23);
            txtDescricao.TabIndex = 9;
            // 
            // btnExcluir
            // 
            btnExcluir.Font = new Font("Segoe UI", 14.25F, FontStyle.Bold, GraphicsUnit.Point, 0);
            btnExcluir.Location = new Point(492, 537);
            btnExcluir.Name = "btnExcluir";
            btnExcluir.Size = new Size(186, 37);
            btnExcluir.TabIndex = 10;
            btnExcluir.Text = "Excluir Produto";
            btnExcluir.UseVisualStyleBackColor = true;
            btnExcluir.Click += btnExcluir_Click;
            // 
            // btnAtualizar
            // 
            btnAtualizar.Font = new Font("Segoe UI", 14.25F, FontStyle.Bold, GraphicsUnit.Point, 0);
            btnAtualizar.Location = new Point(492, 366);
            btnAtualizar.Name = "btnAtualizar";
            btnAtualizar.Size = new Size(186, 37);
            btnAtualizar.TabIndex = 11;
            btnAtualizar.Text = "Atualizar Produto";
            btnAtualizar.UseVisualStyleBackColor = true;
            btnAtualizar.Click += btnAtualizar_Click;
            // 
            // dgvPedidos
            // 
            dgvPedidos.ColumnHeadersHeightSizeMode = DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            dgvPedidos.Location = new Point(705, 303);
            dgvPedidos.Name = "dgvPedidos";
            dgvPedidos.Size = new Size(433, 271);
            dgvPedidos.TabIndex = 12;
            // 
            // btnAvancarPedido
            // 
            btnAvancarPedido.Font = new Font("Segoe UI", 14.25F, FontStyle.Bold, GraphicsUnit.Point, 0);
            btnAvancarPedido.Location = new Point(492, 426);
            btnAvancarPedido.Name = "btnAvancarPedido";
            btnAvancarPedido.Size = new Size(186, 34);
            btnAvancarPedido.TabIndex = 13;
            btnAvancarPedido.Text = "Avançar Pedido";
            btnAvancarPedido.UseVisualStyleBackColor = true;
            btnAvancarPedido.Click += btnAvancarPedido_Click;
            // 
            // btnCSV
            // 
            btnCSV.Font = new Font("Segoe UI", 14.25F, FontStyle.Bold, GraphicsUnit.Point, 0);
            btnCSV.Location = new Point(492, 480);
            btnCSV.Name = "btnCSV";
            btnCSV.Size = new Size(186, 35);
            btnCSV.TabIndex = 14;
            btnCSV.Text = "Exportar CSV";
            btnCSV.UseVisualStyleBackColor = true;
            btnCSV.Click += btnCSV_Click;
            // 
            // dgvCategorias
            // 
            dgvCategorias.ColumnHeadersHeightSizeMode = DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            dgvCategorias.Location = new Point(705, 12);
            dgvCategorias.Name = "dgvCategorias";
            dgvCategorias.Size = new Size(433, 205);
            dgvCategorias.TabIndex = 15;
            // 
            // btnCategoria
            // 
            btnCategoria.Font = new Font("Segoe UI", 14.25F, FontStyle.Bold, GraphicsUnit.Point, 0);
            btnCategoria.Location = new Point(502, 13);
            btnCategoria.Name = "btnCategoria";
            btnCategoria.Size = new Size(197, 33);
            btnCategoria.TabIndex = 17;
            btnCategoria.Text = "Cadastrar Categoria";
            btnCategoria.UseVisualStyleBackColor = true;
            btnCategoria.Click += btnCategoria_Click;
            // 
            // txtCategoria
            // 
            txtCategoria.Location = new Point(502, 52);
            txtCategoria.Name = "txtCategoria";
            txtCategoria.Size = new Size(197, 23);
            txtCategoria.TabIndex = 18;
            // 
            // btnExcluirCategoria
            // 
            btnExcluirCategoria.Font = new Font("Segoe UI", 14.25F, FontStyle.Bold, GraphicsUnit.Point, 0);
            btnExcluirCategoria.Location = new Point(941, 223);
            btnExcluirCategoria.Name = "btnExcluirCategoria";
            btnExcluirCategoria.Size = new Size(197, 37);
            btnExcluirCategoria.TabIndex = 19;
            btnExcluirCategoria.Text = "Excluir Categoria";
            btnExcluirCategoria.UseVisualStyleBackColor = true;
            btnExcluirCategoria.Click += btnExcluirCategoria_Click;
            // 
            // Form1
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(1150, 586);
            Controls.Add(btnExcluirCategoria);
            Controls.Add(txtCategoria);
            Controls.Add(btnCategoria);
            Controls.Add(dgvCategorias);
            Controls.Add(btnCSV);
            Controls.Add(btnAvancarPedido);
            Controls.Add(dgvPedidos);
            Controls.Add(btnAtualizar);
            Controls.Add(btnExcluir);
            Controls.Add(txtDescricao);
            Controls.Add(label4);
            Controls.Add(btnCadastrar);
            Controls.Add(txtEstoque);
            Controls.Add(label3);
            Controls.Add(txtPreco);
            Controls.Add(label2);
            Controls.Add(txtNome);
            Controls.Add(label1);
            Controls.Add(dgvProdutos);
            Name = "Form1";
            Text = "HyperCore Admin";
            Load += Form1_Load;
            ((System.ComponentModel.ISupportInitialize)dgvProdutos).EndInit();
            ((System.ComponentModel.ISupportInitialize)dgvPedidos).EndInit();
            ((System.ComponentModel.ISupportInitialize)dgvCategorias).EndInit();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private DataGridView dgvProdutos;
        private Label label1;
        private TextBox txtNome;
        private Label label2;
        private TextBox txtPreco;
        private Label label3;
        private TextBox txtEstoque;
        private Button btnCadastrar;
        private Label label4;
        private TextBox txtDescricao;
        private Button btnExcluir;
        private Button btnAtualizar;
        private DataGridView dgvPedidos;
        private Button btnAvancarPedido;
        private Button btnCSV;
        private DataGridView dgvCategorias;
        private Button btnCategoria;
        private TextBox txtCategoria;
        private Button btnExcluirCategoria;
    }
}
