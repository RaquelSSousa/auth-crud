import React, { act, useState } from "react";
import { usePage, useForm } from '@inertiajs/inertia-react';
import AppLayout from '@/layouts/app-layout';
import { DeleteIcon, EditIcon } from '@mui/icons-material';

export default function Index({ }) {
    return "deu certo";

    const { disciplines, flash } = usePage().props;

    const { editing, setEditing } = useState(null);

    const [open, setOpen] = useState(false);

    const { data, setData, post, put, delete: destroy, reset, processing, errors } = useForm({
        name: '',
        code: '',
        ch: '',
        active: false,
        description: '',
    });

    // Função para atualizar os campos do formulário
    const handleChange = (e) => {
        const { name, type, value, checked } = e.target;
        setData(name, type === 'checkbox' ? checked : value);
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        if (editing) {
            put(route('disciplines.update', editing.id), {
                onSuccess: () => {
                    reset();
                    setEditing(null);
                    setOpen(false);
                }
            });
        } else {
            post(route('disciplines.store'), {
                onSuccess: () => {
                    reset();
                    setOpen(false);
                }
            });
        }

    };



    return (
        <AppLayout>
            <div className="container mx-auto p-4">
                <h1 className="text-2xl font-bold mb-4">Disciplines</h1>

                <table className="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th className="py-2 px-4 border-b">ID</th>
                            <th className="py-2 px-4 border-b">Name</th>
                            <th className="py-2 px-4 border-b">Description</th>
                            <th className="py-2 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {disciplines.map((discipline) => (
                            <tr key={discipline.id}>
                                <td className="py-2 px-4 border-b">{discipline.id}</td>
                                <td className="py-2 px-4 border-b">{discipline.name}</td>
                                <td className="py-2 px-4 border-b">{discipline.description}</td>
                                <td className="py-2 px-4 border-b">
                                    <button className="text-blue-500 hover:text-blue-700 mr-2">
                                        <EditIcon />
                                    </button>
                                    <button className="text-red-500 hover:text-red-700">
                                        <DeleteIcon />
                                    </button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>

                <div className="mt-6">
                    <h2 className="text-xl font-bold mb-4">Add New Discipline</h2>
                    <form onSubmit={handleSubmit} className="space-y-4">
                        <div>
                            <label className="block text-sm font-medium text-gray-700">Name</label>
                            <input
                                type="text"
                                name="name"
                                value={data.name}
                                onChange={handleChange}
                                className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                            />
                            {errors.name && <div className="text-red-500 text-sm mt-1">{errors.name}</div>}
                        </div>
                        <div>
                            <label className="block text-sm font-medium text-gray-700">Description</label>
                            <textarea
                                name="description"
                                value={data.description}
                                onChange={handleChange}
                                className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                            ></textarea>
                            {errors.description && <div className="text-red-500 text-sm mt-1">{errors.description}</div>}
                        </div>
                        <div>
                            <button
                                type="submit"
                                disabled={processing}
                                className="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
                            >
                                {processing ? 'Saving...' : 'Save'}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </AppLayout>
    );
}
