using MySql.Data.MySqlClient;

namespace HyperCoreDesktop
{
    public class Database
    {
        private string connectionString =
            "server=localhost;" +
            "database=hypercore_db;" +
            "uid=root;" +
            "pwd=;";

        public MySqlConnection GetConnection()
        {
            return new MySqlConnection(connectionString);
        }
    }
}