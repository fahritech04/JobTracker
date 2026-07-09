"use client";

import { useEffect, useState } from "react";
import { useRouter } from "next/navigation";
import axios from "@/lib/axios";
import { AxiosError } from "axios";

// Mendefinisikan struktur data agar TypeScript tahu bentuk data lamaran kita
interface Application {
  id: number;
  company_name: string;
  position: string;
  status: string;
}

export default function Dashboard() {
  const router = useRouter();
  const [applications, setApplications] = useState<Application[]>([]);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    const fetchApplications = async () => {
      try {
        // Axios akan otomatis menyisipkan Token di sini berkat Interceptor yang kita buat
        const response = await axios.get("/api/applications");
        setApplications(response.data);
      } catch (error) {
        const axiosError = error as AxiosError;
        // Jika ditolak oleh Laravel (401 Unauthorized), berarti Token hilang/kadaluarsa.
        // Tendang kembali ke halaman Login.
        if (axiosError.response?.status === 401) {
          localStorage.removeItem("token");
          router.push("/login");
        }
      } finally {
        setIsLoading(false);
      }
    };

    fetchApplications();
  }, [router]);

  const handleLogout = () => {
    // Hapus token dari memori browser dan arahkan ke login
    localStorage.removeItem("token");
    router.push("/login");
  };

  if (isLoading) {
    return <div className="flex min-h-screen items-center justify-center">Memuat data dashboard...</div>;
  }

  return (
    <div className="min-h-screen bg-gray-50 p-8">
      <div className="mx-auto max-w-4xl">
        {/* Bagian Header Dashboard */}
        <div className="mb-8 flex items-center justify-between">
          <h1 className="text-3xl font-bold text-gray-900">Job Tracker Dashboard</h1>
          <button onClick={handleLogout} className="rounded-md bg-red-100 px-4 py-2 text-sm font-semibold text-red-600 hover:bg-red-200">
            Logout
          </button>
        </div>

        {/* Bagian Tabel/Daftar Lamaran */}
        <div className="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
          <h2 className="mb-4 text-xl font-semibold">Daftar Lamaran Saya</h2>

          {applications.length === 0 ? (
            <div className="rounded-lg border-2 border-dashed border-gray-200 p-8 text-center text-gray-500">Belum ada data lamaran. Nanti kita akan buat tombol Tambah Lamaran di sini!</div>
          ) : (
            <ul className="space-y-3">
              {applications.map((app) => (
                <li key={app.id} className="flex items-center justify-between rounded-lg border p-4 hover:bg-gray-50">
                  <div>
                    <p className="text-lg font-bold text-gray-900">{app.company_name}</p>
                    <p className="text-gray-600">{app.position}</p>
                  </div>
                  <span className="h-fit rounded-full bg-blue-100 px-3 py-1 text-sm capitalize text-blue-800">{app.status}</span>
                </li>
              ))}
            </ul>
          )}
        </div>
      </div>
    </div>
  );
}
